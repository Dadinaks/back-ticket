<?php

namespace Dadinaks\Category\Adapter\Dto;

final class OutputDto
{
    public function __construct(
        public readonly string $uid,
        public readonly string $category,
        public readonly bool $isActive,
        public readonly \DateTimeImmutable $createdAt,
        public readonly ?\DateTimeImmutable $updatedAt,
    ) {}
}
