<?php

namespace Dadinaks\Task\Adapter\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class InputDto
{
    public function __construct(
        #[Assert\NotBlank()]
        public readonly ?string $category,
    ) {}
}
