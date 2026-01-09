<?php

namespace Dadinaks\Agency\Application\UseCase;

use Dadinaks\Agency\Adapter\Dto\OutputDto;
use Dadinaks\Agency\Domain\Repository\AgencyRepositoryInterface;

final class UpdateAgency
{
    public function __construct(
        private AgencyRepositoryInterface $repository
    ) {}

    public function execute(string $uid, ?string $code, ?string $label): OutputDto
    {
        $agency = $this->repository->findByUid($uid);

        if (!$agency) {
            throw new \DomainException('Agency not found.');
        }

        if ($code !== null) {
            $existingByCode = $this->repository->findByCode($code);

            if ($existingByCode && $existingByCode->getUid() !== $uid) {
                throw new \DomainException(
                    sprintf('Agency with code "%s" already exists.', $code)
                );
            }
        }

        if ($label !== null) {
            $existingByLabel = $this->repository->findByLabel($label);

            if ($existingByLabel && $existingByLabel->getUid() !== $uid) {
                throw new \DomainException(
                    sprintf('Agency with label "%s" already exists.', $label)
                );
            }
        }
        $agency->update($code, $label);

        $this->repository->save($agency);

        return new OutputDto(
            uid: (string) $agency->getUid(),
            code: $agency->getCode(),
            label: $agency->getLabel()
        );
    }
}
