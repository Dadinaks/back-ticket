<?php

namespace Dadinaks\Task\Domain\Entity;

use Dadinaks\Task\Domain\Enum\Quote;
use Symfony\Component\Uid\Uuid;

final class Task
{
    private string $uid;

    private string $task;

    private float $deadline;

    private Quote $quoting;

    private bool $isActive;

    private \DateTimeImmutable $createdAt;

    private ?\DateTimeImmutable $updatedOn = null;

    private Category $category;

    public function __construct(string $task, float $deadline, Quote $quoting, Category $category)
    {
        $this->uid       = Uuid::v7()->toString();
        $this->task      = $task;
        $this->deadline  = $deadline;
        $this->quoting   = $quoting;
        $this->category  = $category;
        $this->isActive  = true;
        $this->createdAt = new \DateTimeImmutable();
    }

    public static function fromState(array $state): self
    {
        $task = new self($state['task'], $state['deadline'], $state['quoting'], $state['category']);
        $task->uid       = $state['uid'];
        $task->isActive  = $state['isActive'];
        $task->createdAt = $state['createdAt'];
        $task->updatedOn = $state['updatedOn'];

        return $task;
    }

    public function update(?string $task, ?float $deadline, ?Quote $quoting, ?Category $category, ?bool $isActive): void
    {
        if ($task !== null) {
            $this->task = $task;
        }
        if ($deadline !== null) {
            $this->deadline = $deadline;
        }
        if ($quoting !== null) {
            $this->quoting = $quoting;
        }
        if ($category !== null) {
            $this->category = $category;
        }
        if ($isActive !== null) {
            $this->isActive = $isActive;
        }
        $this->updatedOn = new \DateTimeImmutable();
    }

    public function getUid(): string
    {
        return $this->uid;
    }

    public function getTask(): string
    {
        return $this->task;
    }

    public function getDeadline(): float
    {
        return $this->deadline;
    }

    public function getQuoting(): Quote
    {
        return $this->quoting;
    }

    public function getCategory(): Category
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

    public function getUpdatedOn(): ?\DateTimeImmutable
    {
        return $this->updatedOn;
    }
}
