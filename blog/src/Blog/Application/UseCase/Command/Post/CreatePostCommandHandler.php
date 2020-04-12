<?php
declare(strict_types=1);

namespace App\Blog\Application\UseCase\Command\Post;

use App\Blog\Domain\Post\Policy\PublishPolicyInterface;
use App\Blog\Domain\Post\Policy\SlugPolicyInterface;
use App\Blog\Domain\Post\PostContent;
use App\Blog\Domain\Post\PostFactory;
use App\Blog\Domain\Post\PostRepositoryInterface;

class CreatePostCommandHandler
{
    private PostRepositoryInterface $postRepository;

    private PostFactory $postFactory;

    private PublishPolicyInterface $publishPolicy;

    private SlugPolicyInterface $slugPolicy;

    public function __construct(
        PostRepositoryInterface $postRepository,
        PostFactory $postFactory,
        PublishPolicyInterface $publishPolicy,
        SlugPolicyInterface $slugPolicy
    ) {
        $this->postRepository = $postRepository;
        $this->postFactory = $postFactory;
        $this->publishPolicy = $publishPolicy;
        $this->slugPolicy = $slugPolicy;
    }

    public function __invoke(CreatePostCommand $command): void
    {
        $postContent = $this->postFactory->createPostContent($command->getTitle(), $command->getContent());
        $slug = $this->getSlug($postContent, $command->getCustomSlug());

        $postInformation = $this->postFactory->createPostInformation(
            $command->getPublishType(),
            $command->getPlannedPublishAt()
        );
        $postInformation = $this->publishPolicy->checkPublishWay($postInformation);

        $post = $this->postFactory->createPost(
            $this->postFactory->createPostMetadata($slug),
            $postContent,
            $postInformation
        );

        $this->postRepository->add($post);
        $this->postRepository->apply();
    }

    private function getSlug(PostContent $postContent, ?string $customSlug): string
    {
        $slug = $this->slugPolicy->generateSlug($postContent, $customSlug);
        $this->slugPolicy->checkSlug(
            $this->postRepository->getCountBySlug($slug)
        );

        return $slug;
    }
}
