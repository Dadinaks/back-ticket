<?php

namespace Dadinaks\Agency\Application\UseCase;

use Dadinaks\Agency\Domain\Entity\Agency;
use Dadinaks\Agency\Domain\Repository\AgencyRepositoryInterface;
use Dadinaks\Agency\Adapter\Dto\OutputDto;

final class CreateAgency
{
    public function __construct(
        private AgencyRepositoryInterface $repository
    ) {}

    public function execute(string $code, string $label): OutputDto
    {
        if (
            $this->repository->findByCode($code) &&
            $this->repository->findByLabel($label)
        ) {
            throw new \DomainException(
                sprintf('Agency %s - %s already exists.', $code, $label)
            );
        } elseif ($this->repository->findByCode($code)) {
            throw new \DomainException(
                sprintf('Agency with code %s already exists.', $code)
            );
        } else if ($this->repository->findByLabel($label)) {
            throw new \DomainException(
                sprintf('Agency with label %s already exists.', $label)
            );
        }

        $agency = Agency::create($code, $label);

        $this->repository->save($agency);

        return new OutputDto(
            uid: (string) $agency->getUid(),
            code: $agency->getCode(),
            label: $agency->getLabel()
        );
    }
}
