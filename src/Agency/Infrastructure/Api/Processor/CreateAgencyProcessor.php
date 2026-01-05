<?php

namespace Dadinaks\Agency\Infrastructure\Api\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Dadinaks\Agency\Application\UseCase\CreateAgency;
use Dadinaks\Agency\InterfaceAdapter\Presenter\AgencyJsonPresenter;

final class CreateAgencyProcessor implements ProcessorInterface
{
    public function __construct(
        private CreateAgency $useCase,
        private AgencyJsonPresenter $presenter
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        $agency = $this->useCase->execute(
            $data->code,
            $data->label
        );
        return $this->presenter->present($agency);
    }
}
