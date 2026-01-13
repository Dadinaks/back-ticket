<?php

namespace Dadinaks\Task\Infrastructure\Persistence\Doctrine\Repository;

use Dadinaks\Task\Domain\Entity\Category;
use Dadinaks\Task\Domain\Repository\CategoryRepositoryInterface;
use Dadinaks\Task\Infrastructure\Persistence\Doctrine\Entity\CategoryOrm;
use Doctrine\ORM\EntityManagerInterface;

final class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function save(Category $category): void
    {
        $orm = $this->entityManager->getRepository(CategoryOrm::class)->findOneBy(['uid' => $category->getUid()]);

        if ($orm) {
            $orm->setCategory($category->getCategory());
            $orm->setIsActive($category->getIsActive());
            $orm->setUpdatedAt($category->getUpdatedAt());
        } else {
            $orm = CategoryOrm::fromDomain($category);
            $this->entityManager->persist($orm);
        }

        $this->entityManager->flush();
    }

    public function findByUid(string $uid): ?Category
    {
        $orm = $this->entityManager
            ->getRepository(CategoryOrm::class)
            ->findOneBy(['uid' => $uid]);

        return $orm?->toDomain();
    }

    public function findByCategory(string $category): ?Category
    {
        $orm = $this->entityManager
            ->getRepository(CategoryOrm::class)
            ->findOneBy(['category' => $category]);

        return $orm?->toDomain();
    }

    public function findByActiveCategory(bool $isActive): ?Category
    {
        $orm = $this->entityManager
            ->getRepository(CategoryOrm::class)
            ->findOneBy(['isActive' => $isActive]);

        return $orm?->toDomain();
    }

    public function findAll(): array
    {
        return array_map(
            fn(CategoryOrm $orm) => $orm->toDomain(),
            $this->entityManager->getRepository(CategoryOrm::class)->findAll()
        );
    }
}
