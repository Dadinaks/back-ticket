<?php

namespace Dadinaks\Agency\Infrastructure\Persistence\Doctrine\Entity;

use Dadinaks\Agency\Domain\Entity\Agency;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'Agency')]
class AgencyOrm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'uuid', unique: true)]
    private string $uid;

    #[ORM\Column(length: 255, unique: true)]
    private string $code;

    #[ORM\Column(length: 255)]
    private string $label;

    public static function fromDomain(Agency $agency): self
    {
        $orm = new self();
        $orm->uid   = $agency->getUid();
        $orm->code  = $agency->getCode();
        $orm->label = $agency->getLabel();

        return $orm;
    }

    public function toDomain(): Agency
    {
        return Agency::fromState([
            'uid'   => $this->uid,
            'code'  => $this->code,
            'label' => $this->label,
        ]);
    }
}
