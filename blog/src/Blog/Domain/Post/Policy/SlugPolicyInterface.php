<?php
declare(strict_types=1);

namespace App\Blog\Domain\Post\Policy;

use App\Blog\Domain\Post\PostContent;
use App\Blog\Domain\Post\PostMetadata;

interface SlugPolicyInterface
{
    public function generateSlug(PostContent $postContent, ?string $customSlug): string;

    public function checkSlug(int $countIdenticalSlug, string $slug): void;
}
