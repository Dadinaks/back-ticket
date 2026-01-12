<?php

namespace Dadinaks\Category\Infrastructure\Api\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Dadinaks\Category\Adapter\Interface\CategoryPresenterInterface;
use Dadinaks\Category\Application\UseCase\CreateCategory;
use Dadinaks\Category\Application\UseCase\UpdateCategory;

final class CategoryProcessor implements ProcessorInterface
{
    public function __construct(
        private CreateCategory $useCaseCreate,
        private UpdateCategory $useCaseUpdate,
        private CategoryPresenterInterface $presenter
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        if (isset($uriVariables['uid'])) {
            $category = $this->useCaseUpdate->execute(
                $uriVariables['uid'],
                $data->category,
                $data->isActive
            );

            return $this->presenter->presentSuccess(
                201,
                'Category updated successfully.',
                $category
            );
        }

        $output = $this->useCaseCreate->execute(
            $data->category
        );

        return $this->presenter->presentSuccess(
            201,
            'Category created successfully',
            $output
        );
    }
}
