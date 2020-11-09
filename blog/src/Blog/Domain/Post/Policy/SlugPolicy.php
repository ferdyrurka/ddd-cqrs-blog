<?php

declare(strict_types=1);

namespace App\Blog\Domain\Post\Policy;

use App\Blog\Domain\Post\Exception\FoundException;
use App\Blog\Domain\Post\Exception\InvalidArgumentException;
use App\Blog\Domain\Post\Exception\RuntimeException;
use PHPExtension\src\String\AsciiSlugger;

class SlugPolicy implements SlugPolicyInterface
{
    public function generateSlug(string $title, ?string $customSlug): string
    {
        if ($customSlug) {
            return $customSlug;
        }

        $slug = AsciiSlugger::slug($title);

        if (!$slug) {
            throw new RuntimeException('Slug is empty.');
        }

        return $slug;
    }

    public function checkSlug(int $countIdenticalSlug, string $slug): void
    {
        if ($countIdenticalSlug >= 1) {
            throw new FoundException('Identical slug is found' . $slug);
        }

        if (!$slug) {
            throw new InvalidArgumentException('Slug is required parameters');
        }
    }
}
