<?php

namespace Dadinaks\Agency\Infrastructure\Persistence\Doctrine\Repository;

use Dadinaks\Agency\Domain\Entity\Agency;
use Dadinaks\Agency\Domain\Repository\AgencyRepositoryInterface;
use Dadinaks\Agency\Infrastructure\Persistence\Doctrine\Entity\AgencyOrm;
use Doctrine\ORM\EntityManagerInterface;

final class AgencyRepository implements AgencyRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function findByUid(string $uid): ?Agency
    {
        $orm = $this->entityManager
            ->getRepository(AgencyOrm::class)
            ->findOneBy(['uid' => $uid]);

        return $orm?->toDomain();
    }

    public function findByCode(string $code): ?Agency
    {
        $orm = $this->entityManager
            ->getRepository(AgencyOrm::class)
            ->findOneBy(['code' => $code]);

        return $orm?->toDomain();
    }

    public function findByLabel(string $label): ?Agency
    {
        $orm = $this->entityManager
            ->getRepository(AgencyOrm::class)
            ->findOneBy(['label' => $label]);

        return $orm?->toDomain();
    }

    public function findAll(): array
    {
        return array_map(
            fn(AgencyOrm $orm) => $orm->toDomain(),
            $this->entityManager->getRepository(AgencyOrm::class)->findAll()
        );
    }

    public function save(Agency $agency): void
    {
        $orm = AgencyOrm::fromDomain($agency);

        $this->entityManager->persist($orm);
        $this->entityManager->flush();
    }
}
