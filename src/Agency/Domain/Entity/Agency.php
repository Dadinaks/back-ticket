<?php

namespace Dadinaks\Agency\Domain\Entity;

use Symfony\Component\Uid\Uuid;

final class Agency
{
    private int $id;
    private Uuid $uuid;
    private String $code;
    private String $label;


    private function __construct(String $code, String $label)
    {
        $this->uuid = Uuid::v7();
        $this->code = $code;
        $this->label = $label;
    }

    public static function create(String $code, String $label): self
    {
        return new self($code, $label);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUid(): Uuid
    {
        return $this->uuid;
    }

    public function getCode(): String
    {
        return $this->code;
    }

    public function setCode(String $code): String
    {
        return $this->code = $code;
    }

    public function getLabel(): String
    {
        return $this->label;
    }

    public function setLabel(String $label): String
    {
        return $this->label = $label;
    }
}
