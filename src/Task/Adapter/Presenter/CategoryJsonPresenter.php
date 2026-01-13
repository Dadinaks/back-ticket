<?php

namespace Dadinaks\Task\Adapter\Presenter;

use Dadinaks\Task\Adapter\Dto\OutputDto;
use Dadinaks\Task\Adapter\Interface\CategoryPresenterInterface;

/**
 * A presenter dedicated to transforming business data into a standardized JSON response.
 * It implements CategoryPresenterInterface and provides two public methods:
 *
 * - **presentSuccess()** : generates a JSON structure indicating successful processing.
 *   The `data` field is normalized: if only one `OutputDto` is provided, it is encapsulated
 *   in an array; if an array of `OutputDto` is provided, each object is converted into
 *   its associated array (uid, category, isActive, createdAt, updatedAt).
 *
 * - **presentError()** : returns a JSON structure indicating failure; the `data` field
 *   is always an empty array.
 *
 * The presenter thus guarantees a consistent response format for all routes exposed by the agency.
 *
 * @author Dadinaks Cedrick <cedrick.henintsoa.8821@gmail.com>
 */
final class CategoryJsonPresenter implements CategoryPresenterInterface
{
    public function presentSuccess(int $code, string $message, array|OutputDto $data): array
    {
        return [
            'success'   => true,
            'code'      => $code,
            'message'   => $message,
            'data'      => $this->normalize($data),
        ];
    }

    public function presentError(int $code, string $message, ?array $data): array
    {
        return [
            'success'   => false,
            'code'      => $code,
            'message'   => $message,
            'data'      => [],
        ];
    }

    private function normalize(array|OutputDto $data): array
    {
        if ($data instanceof OutputDto) {
            return [$this->normalizeDto($data)];
        }

        return array_map(
            fn(OutputDto $dto) => $this->normalizeDto($dto),
            $data
        );
    }

    private function normalizeDto(OutputDto $dto): array
    {
        return [
            'uid'       => $dto->uid,
            'category'  => $dto->category,
            'isActive'  => $dto->isActive,
            'createdAt' => $dto->createdAt,
            'updatedAt' => $dto->updatedAt
        ];
    }
}
