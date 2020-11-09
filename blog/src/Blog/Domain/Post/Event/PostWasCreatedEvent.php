<?php

declare(strict_types=1);

namespace App\Blog\Domain\Post\Event;

use App\Blog\Domain\Shared\PostId;
use App\Shared\Domain\Event;

class PostWasCreatedEvent extends Event
{
    private PostId $postId;

    public function __construct(PostId $postId)
    {
        $this->postId = $postId;
    }

    public function getPostId(): PostId
    {
        return $this->postId;
    }
}
