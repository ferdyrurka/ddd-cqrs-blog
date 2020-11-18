<?php

declare(strict_types=1);

namespace App\Blog\Domain\Post;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
final class Content
{
    /**
     * @ORM\Column(type="string", length=512)
     */
    private string $title;

    /**
     * Markdown
     * @ORM\Column(type="text")
     */
    private string $content;

    public function __construct(string $title, string $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
