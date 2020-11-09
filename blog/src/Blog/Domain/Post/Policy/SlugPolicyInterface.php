<?php

declare(strict_types=1);

namespace App\Blog\Domain\Post\Policy;

interface SlugPolicyInterface
{
    public function generateSlug(string $title, ?string $customSlug): string;

    public function checkSlug(int $countIdenticalSlug, string $slug): void;
}
