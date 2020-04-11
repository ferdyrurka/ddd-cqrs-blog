<?php
declare(strict_types=1);

namespace App\Shared\Infrastructure\UnityOfWork;

use Doctrine\DBAL\ConnectionException;
use Doctrine\ORM\EntityManagerInterface;

class UnityOfWork implements UnityOfWorkInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function commit(): void
    {
        $this->entityManager->beginTransaction();
        try {
            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();
        } catch (ConnectionException $e) {
            $this->entityManager->getConnection()->rollBack();
            $this->entityManager->close();

            throw $e;
        }
    }

    public function clear(): void
    {
        $this->entityManager->clear();
    }

    public function rollback(): void
    {
        $this->entityManager->rollback();
    }
}