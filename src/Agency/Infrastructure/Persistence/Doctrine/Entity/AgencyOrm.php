<?php

namespace Dadinaks\Agency\Infrastructure\Persistence\Doctrine\Entity;

use Dadinaks\Agency\Domain\Entity\Agency;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
#[ORM\Table(name: 'Agency')]
class AgencyOrm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $uid;

    #[ORM\Column(length: 255, unique: true)]
    private string $code;

    #[ORM\Column(length: 255)]
    private string $label;

    public function __construct(Uuid $uid, string $code, ?string $label)
    {
        $this->uid = $uid;
        $this->code = $code;
        $this->label = $label;
    }

    public function toDomain(): Agency
    {
        return Agency::create(
            $this->code,
            $this->label
        );
    }
}
