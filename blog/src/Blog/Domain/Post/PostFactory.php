<?php

declare(strict_types=1);

namespace App\Blog\Domain\Post;

use App\Blog\Domain\Post\Exception\InvalidArgumentException;
use App\Blog\Domain\Post\Type\PublishType;
use App\Blog\Domain\Shared\PostId;
use DateTime;
use PHPExtension\src\Uuid\Uuid;

final class PostFactory
{
    public function createPostContent(string $title, string $content): Content
    {
        return new Content($title, $content);
    }

    public function createPostMetadata(string $slug): Metadata
    {
        return new Metadata($slug);
    }

    public function createPostInformation(
        string $publishType,
        ?DateTime $plannedPublishAt = null
    ): Information {
        $postInformation = new Information($publishType, $plannedPublishAt);

        if (PublishType::NOW()->equals($postInformation->getPublishType())) {
            $postInformation->publishPost();

            return $postInformation;
        }

        if (!$postInformation->getPlannedPublishAt()) {
            throw new InvalidArgumentException('If use cron publish type you must set planned publish date');
        }

        return $postInformation;
    }

    public function createPostFromData(
        PostId $postId,
        string $title,
        string $content,
        string $publishType,
        ?DateTime $plannedPublishAt,
        string $slug
    ): Post {
        return new Post(
            $postId,
            $this->createPostContent($title, $content),
            $this->createPostInformation($publishType, $plannedPublishAt),
            $this->createPostMetadata($slug)
        );
    }

    public function createPostId(): PostId
    {
        return new PostId((string) Uuid::createUuid());
    }
}
