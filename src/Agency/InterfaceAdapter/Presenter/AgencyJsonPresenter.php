<?php

namespace Dadinaks\Agency\InterfaceAdapter\Presenter;

use Dadinaks\Agency\Domain\Entity\Agency;
use Dadinaks\Agency\InterfaceAdapter\Dto\OutputDto;

final class AgencyJsonPresenter
{
    public function present(Agency $agency): OutputDto
    {
        return new OutputDTO(
            uid: $agency->getUid()->toRfc4122(),
            code: $agency->getCode(),
            label: $agency->getLabel()
        );
    }
}
