<?php

declare(strict_types=1);

namespace App\Blog\Application\UseCase\Command\Category;

use App\Blog\Application\Query\Category\CategoryQuery;
use App\Blog\Domain\Category\CategoryFactory;
use App\Blog\Domain\Category\CategoryRepositoryInterface;
use App\Shared\Domain\Exception\UniqueException;

class CreateCategoryCommandHandler
{
    private CategoryQuery $categoryQuery;

    private CategoryRepositoryInterface $categoryRepository;

    private CategoryFactory $categoryFactory;

    public function __construct(
        CategoryQuery $categoryQuery,
        CategoryRepositoryInterface $categoryRepository,
        CategoryFactory $categoryFactory
    ) {
        $this->categoryQuery = $categoryQuery;
        $this->categoryRepository = $categoryRepository;
        $this->categoryFactory = $categoryFactory;
    }

    public function __invoke(CreateCategoryCommand $command): void
    {
        if ($this->categoryQuery->getCountByName($command->getName()) > 0) {
            throw new UniqueException('Category name required unique!');
        }

        $category = $this->categoryFactory->createCategory($command->getName());

        $this->categoryRepository->add($category);

        $this->categoryRepository->commit();
    }
}
