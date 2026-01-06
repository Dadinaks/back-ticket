<?php

namespace Dadinaks\Agency\Infrastructure\Api\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Dadinaks\Agency\Application\UseCase\CreateAgency;
use Dadinaks\Agency\InterfaceAdapter\Interface\AgencyPresenterInterface;

final class CreateAgencyProcessor implements ProcessorInterface
{
    public function __construct(
        private CreateAgency $useCase,
        private AgencyPresenterInterface $presenter
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        try {
            $output = $this->useCase->execute(
                $data->code,
                $data->label
            );

            return $this->presenter->presentSuccess(
                201,
                'Agency created successfully',
                $output
            );
        } catch (\DomainException $e) {
            return $this->presenter->presentError(
                409,
                $e->getMessage(),
                []
            );
        }
    }
}
