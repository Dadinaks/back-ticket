<?php

namespace Dadinaks\Agency\Infrastructure\Api\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Dadinaks\Agency\Application\UseCase\ListAgency;
use Dadinaks\Agency\InterfaceAdapter\Interface\AgencyPresenterInterface;

final class ListAgencyProvider implements ProviderInterface
{
    public function __construct(
        private ListAgency $useCase,
        private AgencyPresenterInterface $presenter
    ) {}

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        try {
            $agencies = $this->useCase->execute();

            return $this->presenter->presentSuccess(
                200,
                'Agency list',
                $agencies
            );
        } catch (\DomainException $e) {
            return $this->presenter->presentError(
                404,
                $e->getMessage(),
                []
            );
        }
    }
}
