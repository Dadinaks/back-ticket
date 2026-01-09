<?php

namespace Dadinaks\Category\Domain\Entity;

use Symfony\Component\Uid\Uuid;

final class Category
{
    private string $uid;

    private string $category;

    private bool $isActive;

    private \DateTimeImmutable $createdAt;

    private \DateTimeImmutable $updatedAt;

    public function __construct(string $category)
    {
        $this->uid       = Uuid::v7()->toString();
        $this->category  = $category;
        $this->isActive  = true;
        $this->createdAt = new \DateTimeImmutable();
    }

    public static function fromState(array $state): self
    {
        $category = new self($state['category']);
        $category->uid       = $state['uid'];
        $category->isActive  = $state['is_active'];
        $category->createdAt = $state['created_at'];
        $category->updatedAt = $state['updated_at'];

        return $category;
    }

    public function update(?string $category): void
    {
        if ($category !== null) {
            $this->category = $category;
        }
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getUid(): string
    {
        return $this->uid;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
