<?php

namespace Dadinaks\Agency\Adapter\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class UpdateInputDto
{
    public function __construct(
        #[Assert\Sequentially([
            new Assert\Length(min: 5, max: 5),
            new Assert\Regex(pattern: '/^[0-9]+$/', message: 'Code must contain only five digits.')
        ])]
        public ?string $code,
        public ?string $label
    ) {}
}
