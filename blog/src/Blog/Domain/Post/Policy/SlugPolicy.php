<?php
declare(strict_types=1);

namespace App\Blog\Domain\Post\Policy;

use App\Blog\Domain\Post\Exception\FoundException;
use App\Blog\Domain\Post\PostContent;
use PHPExtension\src\String\AsciiSlugger;

class SlugPolicy implements SlugPolicyInterface
{
    public function generateSlug(PostContent $postContent, ?string $customSlug): string
    {
        if ($customSlug) {
            return $customSlug;
        }

        return AsciiSlugger::slug($postContent->getTitle());
    }

    public function checkSlug(int $countIdenticalSlug): void
    {
        if ($countIdenticalSlug >= 1) {
            throw new FoundException('Identical slug is found');
        }
    }
}
