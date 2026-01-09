<?php

namespace Dadinaks\Category\Adapter\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class inputDto
{
    public function __construct(
        #[Assert\NotBlank()]
        public readonly ?string $category,
    ) {}
}
