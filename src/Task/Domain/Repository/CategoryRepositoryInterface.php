<?php

namespace Dadinaks\Task\Domain\Repository;

use Dadinaks\Task\Domain\Entity\Category;

interface CategoryRepositoryInterface
{
    public function save(Category $category): void;

    public function findByUid(string $uid): ?Category;

    public function findByCategory(string $category): ?Category;
    
    public function findByActiveCategory(bool $isActive): ?Category;

    public function findAll(): array;
}
