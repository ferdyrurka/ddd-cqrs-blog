<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category;

interface CategoryRepositoryInterface
{
    public function add(Category $category): void;

    public function commit(): void;
}
