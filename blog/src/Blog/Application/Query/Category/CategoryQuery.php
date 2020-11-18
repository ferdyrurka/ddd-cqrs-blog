<?php

declare(strict_types=1);

namespace App\Blog\Application\Query\Category;

interface CategoryQuery
{
    public function getCountByName(string $name): int;

    public function getCountById(int $id): int;
}
