<?php
declare(strict_types=1);

namespace App\Repository;

use App\Domain\Entity\Post;
use App\Query\PostQuery;
use App\Query\ViewObject\PostViewObject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class PostRepository
 * @package App\Repository
 */
class PostRepository extends ServiceEntityRepository implements PostQuery
{
    /**
     * PostRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $posts = $this->createQueryBuilder('p')
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery()
            ->execute()
        ;

        if (empty($posts)) {
            return [];
        }

        $postsView = [];

        foreach ($posts as $post) {
            $postsView[] = new PostViewObject(
                $post->getCreatedAt(),
                $post->getContent(),
                $post->getTitle()
            );
        }

        return $postsView;
    }

    /**
     * @param Post $post
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Post $post): void
    {
        $em = $this->getEntityManager();
        $em->remove($post);
        $em->flush();
    }

    /**
     * @param Post $post
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Post $post): void
    {
        $em = $this->getEntityManager();
        $em->persist($post);
        $em->flush();
    }
}
