<?php

namespace Dadinaks\Agency\InterfaceAdapter\Presenter;

use Dadinaks\Agency\InterfaceAdapter\Dto\OutputDto;
use Dadinaks\Agency\InterfaceAdapter\Interface\AgencyPresenterInterface;

final class AgencyJsonPresenter implements AgencyPresenterInterface
{
    public function presentSuccess(
        int $code,
        string $message,
        array|OutputDto $data
    ): array {
        return [
            'success'   => true,
            'code'      => $code,
            'message'   => $message,
            'data'      => $this->normalize($data),
        ];
    }

    public function presentError(
        int $code,
        string $message,
        ?array $data
    ): array {
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
            'uid'   => $dto->uid,
            'code'  => $dto->code,
            'label' => $dto->label
        ];
    }
}
