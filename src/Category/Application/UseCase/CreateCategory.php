<?php

namespace Dadinaks\Category\Application\UseCase;

use Dadinaks\Category\Adapter\Dto\OutputDto;
use Dadinaks\Category\Domain\Entity\Category;
use Dadinaks\Category\Domain\Repository\CategoryRepositoryInterface;

final class CreateCategory
{
    public function __construct(
        private CategoryRepositoryInterface $repository
    ) {}

    public function execute(string $category): OutputDto
    {
        if ($this->repository->findByCategory($category)) {
            throw new \DomainException(
                sprintf('Category : "%s" already exists.', $category)
            );
        }

        $category = new Category($category);
        $this->repository->save($category);

        return new OutputDto(
            uid: (string) $category->getUid(),
            category: $category->getCategory(),
            isActive: $category->getIsActive(),
            createdAt: $category->getCreatedAt(),
            updatedAt: $category->getUpdatedAt()
        );
    }
}
