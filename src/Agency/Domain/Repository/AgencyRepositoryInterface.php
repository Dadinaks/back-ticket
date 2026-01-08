<?php

namespace Dadinaks\Agency\Domain\Repository;

use Dadinaks\Agency\Domain\Entity\Agency;

interface AgencyRepositoryInterface
{
    public function findByUid(string $uid): ?Agency;

    public function findByCode(string $code): ?Agency;

    public function findByLabel(string $label): ?Agency;

    public function findAll(): array;

    public function save(Agency $agency): void;
}
