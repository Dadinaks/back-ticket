<?php

namespace Dadinaks\Agency\Adapter\Dto;

final class OutputDto
{
    public function __construct(
        public string $uid,
        public string $code,
        public string $label
    ) {}
}
