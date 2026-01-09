<?php

namespace Dadinaks\Agency\Domain\Entity;

use Symfony\Component\Uid\Uuid;

final class Agency
{
    private string $uid;

    private string $code;

    private string $label;

    public function __construct(string $code, string $label)
    {
        $this->uid   = Uuid::v7()->toString();
        $this->code  = $code;
        $this->label = $label;
    }

    public static function fromState(array $state): self
    {
        $agency = new self($state['code'], $state['label']);
        $agency->uid = $state['uid'];

        return $agency;
    }

    public function update(?string $code, ?string $label): void
    {
        if ($code !== null) {
            $this->code = $code;
        }

        if ($label !== null) {
            $this->label = $label;
        }
    }

    public function getUid(): string
    {
        return $this->uid;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getLabel(): string
    {
        return $this->label;
    }
}
