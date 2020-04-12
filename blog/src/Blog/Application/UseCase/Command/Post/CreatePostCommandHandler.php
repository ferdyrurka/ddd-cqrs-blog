<?php
declare(strict_types=1);

namespace App\Blog\Application\UseCase\Command\Post;

use App\Blog\Domain\Post\Policy\PublishPolicyInterface;
use App\Blog\Domain\Post\Policy\SlugPolicyInterface;
use App\Blog\Domain\Post\PostFactory;
use App\Blog\Domain\Post\PostRepositoryInterface;
use App\Shared\Infrastructure\UnityOfWork\UnityOfWork;

class CreatePostCommandHandler
{
    private PostRepositoryInterface $postRepository;

    private PostFactory $postFactory;

    private UnityOfWork $unityOfWork;

    private PublishPolicyInterface $publishPolicy;

    private SlugPolicyInterface $slugPolicy;

    public function __construct(
        PostRepositoryInterface $postRepository,
        PostFactory $postFactory,
        UnityOfWork $unityOfWork,
        PublishPolicyInterface $publishPolicy,
        SlugPolicyInterface $slugPolicy
    ) {
        $this->postRepository = $postRepository;
        $this->postFactory = $postFactory;
        $this->unityOfWork = $unityOfWork;
        $this->publishPolicy = $publishPolicy;
        $this->slugPolicy = $slugPolicy;
    }

    public function __invoke(CreatePostCommand $command): void
    {
        $postContent = $this->postFactory->createPostContent($command->getTitle(), $command->getContent());

        $slug = $this->slugPolicy->generateSlug($postContent, $command->getCustomSlug());
        $this->slugPolicy->checkSlug(
            $this->postRepository->getCountBySlug($slug)
        );
        $postMetadata = $this->postFactory->createPostMetadata($slug);

        $postInformation = $this->postFactory->createPostInformation(
            $command->getPublishType(),
            $command->getPlannedPublishAt()
        );
        $postInformation = $this->publishPolicy->checkPublishWay($postInformation);

        $post = $this->postFactory->createPost($postMetadata, $postContent, $postInformation);

        $this->postRepository->add($post);
        $this->unityOfWork->commit();
    }
}
