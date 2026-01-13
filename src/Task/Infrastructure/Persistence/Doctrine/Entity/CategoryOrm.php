<?php

namespace Dadinaks\Task\Infrastructure\Persistence\Doctrine\Entity;

use Dadinaks\Task\Domain\Entity\Category;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'Category')]
final class CategoryOrm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'uuid', unique: true)]
    private string $uid;

    #[ORM\Column(length: 255)]
    private string $category;

    #[ORM\Column(type: 'boolean')]
    private bool $isActive;

    #[ORM\Column(type: Types::DATETIMETZ_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: Types::DATETIMETZ_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;


    public static function fromDomain(Category $category): self
    {
        $orm = new self();
        $orm->uid   = $category->getUid();
        $orm->category  = $category->getCategory();
        $orm->isActive = $category->getIsActive();
        $orm->createdAt = $category->getCreatedAt();
        $orm->updatedAt = $category->getUpdatedAt();

        return $orm;
    }

    public function toDomain(): Category
    {
        return Category::fromState([
            'uid'       => $this->uid,
            'category'  => $this->category,
            'isActive'  => $this->isActive,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);
    }

    public function setCategory(string $category): string
    {
        return $this->category = $category;
    }

    public function setIsActive(bool $isActive): bool
    {
        return $this->isActive = $isActive;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): ?\DateTimeImmutable
    {
        return $this->updatedAt = $updatedAt;
    }
}
