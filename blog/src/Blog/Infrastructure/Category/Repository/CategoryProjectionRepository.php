<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository;

use App\Blog\Application\Query\Category\CategoryQuery;
use App\Blog\Domain\Category\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategoryProjectionRepository extends ServiceEntityRepository implements CategoryQuery
{
    private const ONE_HOUR_IN_SECONDS = 3600;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function getCountByName(string $name): int
    {
        return (int) $this
            ->createQueryBuilder('c')
            ->select('COUNT(c.categoryId.id) AS count')
            ->where('c.name.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->enableResultCache(self::ONE_HOUR_IN_SECONDS)
            ->getResult()[0]['count']
        ;
    }

    public function getCountById(int $id): int
    {
        return (int) $this
            ->createQueryBuilder('c')
            ->select('COUNT(c.categoryId.id) AS count')
            ->where('c.categoryId.id = :id')
            ->setParameter('id ', $id)
            ->getQuery()
            ->enableResultCache(self::ONE_HOUR_IN_SECONDS)
            ->getResult()[0]['count']
        ;
    }
}
