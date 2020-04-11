<?php
declare(strict_types=1);

namespace App\Blog\Application\UseCase\Command\Post;

use DateTime;

class CreatePostCommand
{
    private string $title;

    private string $content;

    private string $publishType;

    private ?DateTime $plannedPublishAt;

    private ?string $customSlug;

    public function __construct(
        string $title,
        string $content,
        string $publishType,
        ?DateTime $plannedPublishAt = null,
        ?string $customSlug = null
    ) {
        $this->title = $title;
        $this->content = $content;
        $this->publishType = $publishType;
        $this->plannedPublishAt = $plannedPublishAt;
        $this->customSlug = $customSlug;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getPublishType(): string
    {
        return $this->publishType;
    }

    public function getPlannedPublishAt(): ?DateTime
    {
        return $this->plannedPublishAt;
    }

    public function getCustomSlug(): ?string
    {
        return $this->customSlug;
    }
}
