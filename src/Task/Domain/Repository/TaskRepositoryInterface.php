<?php

namespace Dadinaks\Task\Domain\Repository;

use Dadinaks\Task\Domain\Entity\Task;

interface TaskRepositoryInterface
{
    public function save(Task $task): void;

    public function findByUid(string $uid): ?Task;

    public function findByTask(string $task): ?Task;
    
    public function findByActiveTask(bool $isActive): ?Task;

    public function findAll(): array;
}
