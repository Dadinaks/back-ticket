<?php

namespace Dadinaks\Task\Infrastructure\Api\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Dadinaks\Task\Adapter\Interface\CategoryPresenterInterface;
use Dadinaks\Task\Application\UseCase\ListCategory;
use Dadinaks\Task\Application\UseCase\ShowCategory;

final class CategoryProvider implements ProviderInterface
{
    public function __construct(
        private ListCategory $useCaseList,
        private ShowCategory $useCaseShow,
        private CategoryPresenterInterface $presenter
    ) {}

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if (isset($uriVariables['uid'])) {
            $category = $this->useCaseShow->execute($uriVariables['uid']);

            return $this->presenter->presentSuccess(
                200,
                'Category details retrieved successfully.',
                $category
            );
        }

        $categories = $this->useCaseList->execute();

        return $this->presenter->presentSuccess(
            200,
            'List of categories retrieved successfully.',
            $categories
        );
    }
}
