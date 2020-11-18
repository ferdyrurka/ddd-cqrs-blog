<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository;

use App\Blog\Domain\Category\Category;
use App\Blog\Domain\Category\CategoryRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategoryRepository extends ServiceEntityRepository implements CategoryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function add(Category $category): void
    {
        $this->getEntityManager()->persist($category);
    }

    public function commit(): void
    {
        $this->getEntityManager()->flush();
    }
}
