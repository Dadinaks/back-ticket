<?php

namespace Dadinaks\Task\Domain\Repository;

interface RepositoryInterface
{
    public function save(object $entity): void;

    public function findOneBy(array $criteria): ?object;

    public function findAll(): array;
}
