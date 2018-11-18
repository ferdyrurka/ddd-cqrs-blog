<?php
declare(strict_types=1);

namespace App\Query;

/**
 * Interface PostQuery
 * @package App\Query
 */
interface PostQueryInterface
{
    /**
     * @return array
     */
    public function getAll(): array;
}
