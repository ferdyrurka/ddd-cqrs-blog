<?php

declare(strict_types=1);

namespace App\Blog\Application\UseCase\Command\Post;

use App\Blog\Domain\Post\Event\Events;
use App\Blog\Domain\Post\Event\PostWasCreatedEvent;
use App\Blog\Domain\Post\Policy\SlugPolicyInterface;
use App\Blog\Domain\Post\PostFactory;
use App\Blog\Domain\Post\PostRepositoryInterface;
use App\Shared\Infrastructure\EventDispatcher\EventDispatcherInterface;

class CreatePostCommandHandler
{
    private PostRepositoryInterface $postRepository;

    private PostFactory $postFactory;

    private SlugPolicyInterface $slugPolicy;

    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        PostRepositoryInterface $postRepository,
        PostFactory $postFactory,
        SlugPolicyInterface $slugPolicy,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->postRepository = $postRepository;
        $this->postFactory = $postFactory;
        $this->slugPolicy = $slugPolicy;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke(CreatePostCommand $command): void
    {
        $slug = $this->getSlug($command->getTitle(), $command->getCustomSlug());

        $postId = $this->postFactory->createPostId();

        $post = $this->postFactory->createPostFromData(
            $postId,
            $command->getTitle(),
            $command->getContent(),
            $command->getPublishType(),
            $command->getPlannedPublishAt(),
            $slug
        );

        $this->postRepository->add($post);
        $this->postRepository->commit();

        $this->eventDispatcher->dispatch(new PostWasCreatedEvent($postId), Events::POST_WAS_CREATED);
    }

    private function getSlug(string $title, ?string $customSlug): string
    {
        $slug = $this->slugPolicy->generateSlug($title, $customSlug);

        $this->slugPolicy->checkSlug(
            $this->postRepository->getCountBySlug($slug),
            $slug
        );

        return $slug;
    }
}
