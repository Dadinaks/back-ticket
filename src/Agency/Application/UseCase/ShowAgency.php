<?php

namespace Dadinaks\Agency\Application\UseCase;

use Dadinaks\Agency\Domain\Repository\AgencyRepositoryInterface;
use Dadinaks\Agency\InterfaceAdapter\Dto\OutputDto;

final class ShowAgency
{
    public function __construct(
        private AgencyRepositoryInterface $repository
    ) {}

    public function execute(string $uid): OutputDto
    {
        $agency = $this->repository->findByUid($uid);

        if (!$agency) {
            throw new \DomainException(
                sprintf('Agency with uid %s not found.', $uid)
            );
        }

        return new OutputDto(
            uid: (string) $agency->getUid(),
            code: $agency->getCode(),
            label: $agency->getLabel()
        );
    }
}
