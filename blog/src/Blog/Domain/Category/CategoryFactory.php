<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category;

use App\Blog\Domain\Shared\CategoryId;
use PHPExtension\src\Uuid\Uuid;

final class CategoryFactory
{
    public function createCategory(string $name): Category
    {
        return new Category(
            $this->createCategoryId(),
            $this->createName($name)
        );
    }

    private function createName(string $name): Name
    {
        return new Name($name);
    }

    private function createCategoryId(): CategoryId
    {
        return new CategoryId((string) Uuid::createUuid());
    }
}
