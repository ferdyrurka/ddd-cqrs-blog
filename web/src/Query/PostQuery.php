<?php
declare(strict_types=1);

namespace App\Query;

use App\Repository\PostRepository;

/**
 * Class PostQuery
 * @package App\Query
 */
class PostQuery implements PostQueryInterface
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * PostQuery constructor.
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->postRepository->getAll();
    }
}
