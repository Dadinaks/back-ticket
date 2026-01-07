<?php

namespace Dadinaks\Agency\Domain\Repository;

use Dadinaks\Agency\Domain\Entity\Agency;

interface AgencyRepositoryInterface
{
    public function save(Agency $agency, ?string $uid): void;

    public function findByCode(string $code): ?Agency;

    public function findByUid(string $uid): ?Agency;

    public function findByLabel(string $label): ?Agency;

    public function findAll(): array;
}
