<?php

namespace Dadinaks\Agency\Infrastructure\Api\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Dadinaks\Agency\Application\UseCase\CreateAgency;
use Dadinaks\Agency\Application\UseCase\UpdateAgency;
use Dadinaks\Agency\InterfaceAdapter\Interface\AgencyPresenterInterface;

final class AgencyProcessor implements ProcessorInterface
{
    public function __construct(
        private CreateAgency $useCaseCreate,
        private UpdateAgency $useCaseUpdate,
        private AgencyPresenterInterface $presenter
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        try {
            if (isset($uriVariables['uid'])) {
                $agency = $this->useCaseUpdate->execute(
                    $uriVariables['uid'],
                    $data->code,
                    $data->label
                );

                return $this->presenter->presentSuccess(
                    201,
                    'Agency updated successfully.',
                    $agency
                );
            } else {
                $output = $this->useCaseCreate->execute(
                    $data->code,
                    $data->label
                );

                return $this->presenter->presentSuccess(
                    201,
                    'Agency created successfully',
                    $output
                );
            }
        } catch (\DomainException $e) {
            return $this->presenter->presentError(
                409,
                $e->getMessage(),
                []
            );
        }
    }
}
