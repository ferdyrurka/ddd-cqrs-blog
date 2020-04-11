<?php
declare(strict_types=1);

namespace App\Blog\Infrastructure\Post\Repository;

use App\Blog\Domain\Post\Post;
use App\Blog\Domain\Post\PostRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PostRepository extends ServiceEntityRepository implements PostRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function add(Post $post): void
    {
        $this->getEntityManager()->persist($post);
    }

    public function remove(Post $post): void
    {
        $this->getEntityManager()->remove($post);
    }
}
