<?php

namespace Dadinaks\Agency\InterfaceAdapter\Dto;

final class OutputDto
{
    public function __construct(
        public string $uid,
        public string $code,
        public string $label
    ) {}
}
