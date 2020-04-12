<?php
declare(strict_types=1);

namespace App\Blog\Application\Query\Post;

use Doctrine\Common\Collections\Collection;

class FindAllPublishedPostQueryHandler
{
    private PostQuery $postQuery;

    public function __construct(PostQuery $postQuery)
    {
        $this->postQuery = $postQuery;
    }

    public function __invoke(FindAllPublishedPostQuery $findAllPostQuery): Collection
    {
        return $this->postQuery->findAllPublished();
    }
}
