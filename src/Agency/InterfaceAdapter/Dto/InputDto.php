<?php

namespace Dadinaks\Agency\InterfaceAdapter\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class InputDto
{
    public function __construct(
        #[Assert\Sequentially([
            new Assert\NotBlank(message: 'Code should not be blank.'),
            new Assert\Length(min: 5, max: 5),
            new Assert\Regex(pattern: '/^[0-9]+$/', message: 'Code must contain only five digits.')
        ])]
        public string $code,

        #[Assert\Sequentially([
            new Assert\NotBlank(message: 'Code should not be blank.'),
        ])]
        public string $label
    ) {}
}
