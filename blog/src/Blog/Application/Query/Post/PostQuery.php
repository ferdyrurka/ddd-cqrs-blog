<?php

declare(strict_types=1);

namespace App\Blog\Application\Query\Post;

use Doctrine\Common\Collections\Collection;

interface PostQuery
{
    public function findAllPublished(): Collection;
}
