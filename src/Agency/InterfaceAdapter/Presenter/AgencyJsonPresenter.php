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
    ): array {
        return [
            'success'   => false,
            'code'      => $code,
            'message'   => $message,
            'data'      => [],
        ];
    }

    private function normalize(array|OutputDTO $data): array
    {
        if ($data instanceof OutputDTO) {
            return [$this->normalizeDto($data)];
        }

        return array_map(
            fn(OutputDTO $dto) => $this->normalizeDto($dto),
            $data
        );
    }

    private function normalizeDto(OutputDTO $dto): array
    {
        return [
            'uid'   => $dto->uid,
            'code'  => $dto->code,
            'label' => $dto->label
        ];
    }
}
