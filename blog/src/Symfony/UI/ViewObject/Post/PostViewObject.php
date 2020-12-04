<?php

declare(strict_types=1);

namespace App\Symfony\UI\ViewObject\Post;

use DateTime;

class PostViewObject
{
    private string $content;

    private string $title;

    private DateTime $publishedAt;

    private string $slug;

    public function __construct(
        string $content,
        string $title,
        DateTime $publishedAt,
        string $slug
    ) {
        $this->content = $content;
        $this->title = $title;
        $this->publishedAt = $publishedAt;
        $this->slug = $slug;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPublishedAt(): DateTime
    {
        return $this->publishedAt;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
}
