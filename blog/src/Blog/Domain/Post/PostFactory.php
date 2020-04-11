<?php
declare(strict_types=1);

namespace App\Blog\Domain\Post;

use App\Blog\Domain\Shared\PostId;
use DateTime;
use PHPExtension\src\Uuid\Uuid;

class PostFactory
{
    public function createPostContent(string $title, string $content): PostContent
    {
        return new PostContent($title, $content);
    }

    public function createPostMetadata(string $slug): PostMetadata
    {
        return new PostMetadata($slug);
    }

    public function createPostInformation(
        string $publishType,
        ?DateTime $plannedPublishAt = null
    ): PostInformation {
        return new PostInformation($publishType, $plannedPublishAt);
    }

    public function createPost(
        PostMetadata $postMetadata,
        PostContent $postContent,
        PostInformation $postInformation
    ): Post {
        return new Post(
            $this->createPostId(),
            $postContent,
            $postInformation,
            $postMetadata
        );
    }

    public function createPostId(): PostId
    {
        return new PostId((string) Uuid::createUuid());
    }
}
