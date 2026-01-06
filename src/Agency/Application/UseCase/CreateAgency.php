<?php

namespace Dadinaks\Agency\Application\UseCase;

use Dadinaks\Agency\Domain\Entity\Agency;
use Dadinaks\Agency\Domain\Repository\AgencyRepositoryInterface;

final class CreateAgency
{
    public function __construct(
        private AgencyRepositoryInterface $repository
    ) {}

    public function execute(string $code, string $label): Agency
    {
        $existingCode = $this->repository->findByCode($code);
        $existingLabel = $this->repository->findByLabel($label);

        if ($existingCode || $existingLabel) {
            throw new \DomainException('Agency ' . $code . ' - ' . $label . ' already exists.', 500);
        }

        $agency = Agency::create($code, $label);

        $this->repository->save($agency);

        return $agency;
    }
}
