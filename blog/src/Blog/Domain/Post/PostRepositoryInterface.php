<?php
declare(strict_types=1);

namespace App\Blog\Domain\Post;

interface PostRepositoryInterface
{
    public function getCountBySlug(string $slug): int;

    public function add(Post $post): void;

    public function remove(Post $post): void;
}
