<?php
declare(strict_types=1);

namespace App\Query;

use App\Domain\Entity\Post;

/**
 * Interface PostQuery
 * @package App\Query
 */
interface PostQuery
{
    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param Post $post
     */
    public function save(Post $post): void;

    /**
     * @param Post $post
     */
    public function remove(Post $post): void;
}
