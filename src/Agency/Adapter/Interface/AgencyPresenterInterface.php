<?php

namespace Dadinaks\Agency\Adapter\Interface;

use Dadinaks\Agency\Adapter\Dto\OutputDto;


/**
 * Implementing this interface centralizes presentation logic,
 * facilitates consistent response feedback,
 * and ensures a clear separation between business logic (use cases) and the presentation layer.
 * This makes the code more maintainable and testable.
 * @author Dadinaks Cedrick <cedrick.henintsoa.8821@gmail.com>
 */
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
