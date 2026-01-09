<?php

namespace Dadinaks\Category\Application\UseCase;

use Dadinaks\Category\Domain\Repository\CategoryRepositoryInterface;
use Dadinaks\Category\Adapter\Dto\OutputDto;

final class ShowCategory
{
    public function __construct(
        private CategoryRepositoryInterface $repository
    ) {}

    public function execute(string $uid): OutputDto
    {
        $category = $this->repository->findByUid($uid);

        if (!$category) {
            throw new \DomainException(
                sprintf('Category with uid %s not found.', $uid)
            );
        }

        return new OutputDto(
            uid: $category->getUid(),
            category: $category->getcategory(),
            isActive: $category->getIsActive(),
            createdAt: $category->getCreatedAt(),
            updatedAt: $category->getUpdatedAt()
        );
    }
}
