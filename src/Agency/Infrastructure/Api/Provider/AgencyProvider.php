<?php

namespace Dadinaks\Agency\Infrastructure\Api\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Dadinaks\Agency\Application\UseCase\ListAgency;
use Dadinaks\Agency\Application\UseCase\ShowAgency;
use Dadinaks\Agency\Adapter\Interface\AgencyPresenterInterface;

final class AgencyProvider implements ProviderInterface
{
    public function __construct(
        private ListAgency $useCaseList,
        private ShowAgency $useCaseShow,
        private AgencyPresenterInterface $presenter
    ) {}

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if (isset($uriVariables['uid'])) {
            $agency = $this->useCaseShow->execute($uriVariables['uid']);

            return $this->presenter->presentSuccess(
                200,
                'Agency details retrieved successfully.',
                $agency
            );
        }

        $agencies = $this->useCaseList->execute();

        return $this->presenter->presentSuccess(
            200,
            'List of agencies retrieved successfully.',
            $agencies
        );
    }
}
