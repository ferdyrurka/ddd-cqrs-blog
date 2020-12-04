<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Post\Repository;

use App\Blog\Application\Query\Post\PostQuery;
use App\Blog\Domain\Post\Post;
use App\Symfony\UI\ViewObject\Post\PostViewObject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

class PostProjectionRepository extends ServiceEntityRepository implements PostQuery
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function findAllPublished(): Collection
    {
        $posts = $this->createQueryBuilder('p')
            ->select('p.postContent.title, p.postContent.content, p.postInformation.publishedAt, p.postMetadata.slug')
            ->where('p.postInformation.publish = 1')
            ->getQuery()
            ->getResult()
        ;

        $collection = new ArrayCollection();

        foreach ($posts as $post) {
            $collection->add(
                new PostViewObject(
                    $post['postContent.content'],
                    $post['postContent.title'],
                    $post['postInformation.publishedAt'],
                    $post['postMetadata.slug']
                )
            );
        }

        return $collection;
    }
}
