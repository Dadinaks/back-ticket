<?php

namespace Dadinaks\Task\Adapter\Dto;

final class UpdateInputDto
{
    public function __construct(
        public readonly ?string $category,
        public readonly ?bool $isActive,
    ) {}
}
