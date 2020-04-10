<?php
declare(strict_types=1);

namespace App\Blog\UI\Post\Request\DTO;

class CreatePostDTO
{
    public string $title;

    public string $content;

    public string $publishType;

    public ?string $customSlug;
}
