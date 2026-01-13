<?php

namespace Dadinaks\Task\Application\UseCase;

use Dadinaks\Task\Domain\Repository\CategoryRepositoryInterface;
use Dadinaks\Task\Adapter\Dto\OutputDto;

final class ListCategory
{
    public function __construct(
        private CategoryRepositoryInterface $repository
    ) {}

    /**
     * @return OutputDto[]
     */
    public function execute(): array
    {
        $categories = $this->repository->findAll();

        if (empty($categories)) {
            throw new \DomainException('No category was found in the system.');
        }

        return array_map(
            fn($categories) => new OutputDto(
                uid: $categories->getUid(),
                category: $categories->getcategory(),
                isActive: $categories->getIsActive(),
                createdAt: $categories->getCreatedAt(),
                updatedAt: $categories->getUpdatedAt()
            ),
            $categories
        );
    }
}
