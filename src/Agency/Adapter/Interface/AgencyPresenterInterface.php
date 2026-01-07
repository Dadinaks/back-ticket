<?php

namespace Dadinaks\Agency\Adapter\Interface;

use Dadinaks\Agency\Adapter\Dto\OutputDto;

interface AgencyPresenterInterface
{
    public function presentSuccess(
        int $code,
        string $message,
        array|OutputDto $data
    ): array;

    public function presentError(
        int $code,
        string $message,
        ?array $data
    ): array;
}
