<?php

namespace Dadinaks\Category\Application\UseCase;

use Dadinaks\Category\Adapter\Dto\OutputDto;
use Dadinaks\Category\Domain\Repository\CategoryRepositoryInterface;

final class UpdateCategory
{
    public function __construct(
        private CategoryRepositoryInterface $repository
    ) {}

    public function execute(string $uid, ?string $category): OutputDto
    {
        $categories = $this->repository->findByUid($uid);

        if (!$categories) {
            throw new \DomainException('Category not found.');
        }

        if ($category !== null) {
            $existingByCategory = $this->repository->findByCategory($category);

            if ($existingByCategory && $existingByCategory->getUid() !== $uid) {
                throw new \DomainException(
                    sprintf('Category with name "%s" already exists.', $category)
                );
            }
        }

        $categories->update($category);

        $this->repository->save($categories);

        return new OutputDto(
            uid: $categories->getUid(),
            category: $categories->getcategory(),
            isActive: $categories->getIsActive(),
            createdAt: $categories->getCreatedAt(),
            updatedAt: $categories->getUpdatedAt()
        );
    }
}
