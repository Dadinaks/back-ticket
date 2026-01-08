<?php

namespace Dadinaks\Agency\Application\UseCase;

use Dadinaks\Agency\Domain\Repository\AgencyRepositoryInterface;
use Dadinaks\Agency\Adapter\Dto\OutputDto;

final class ListAgency
{
    public function __construct(
        private AgencyRepositoryInterface $repository
    ) {}

    /**
     * @return OutputDto[]
     */
    public function execute(): array
    {
        $agencies = $this->repository->findAll();

        if (empty($agencies)) {
            throw new \DomainException('No agencies found in the system.');
        }

        return array_map(
            fn($agency) => new OutputDto(
                uid: $agency->getUid(),
                code: $agency->getCode(),
                label: $agency->getLabel()
            ),
            $agencies
        );
    }
}
