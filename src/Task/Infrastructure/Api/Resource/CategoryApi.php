<?php

namespace Dadinaks\Task\Infrastructure\Api\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;
use Dadinaks\Task\Adapter\Dto\InputDto;
use Dadinaks\Task\Adapter\Dto\OutputDto;
use Dadinaks\Task\Adapter\Dto\UpdateInputDto;
use Dadinaks\Task\Infrastructure\Api\Processor\CategoryProcessor;
use Dadinaks\Task\Infrastructure\Api\Provider\CategoryProvider;

#[ApiResource(
    shortName: 'Category',
    description: 'Category management resource',
    uriTemplate: '/categories',
    operations: [
        new Post(
            input: InputDto::class,
            output: OutputDto::class,
            processor: CategoryProcessor::class,
            openapi: new Operation(
                summary: 'Create a category',
                description: 'Creates a new category and stores it in the system.',
            )
        ),
        new GetCollection(
            output: OutputDto::class,
            provider: CategoryProvider::class,
            openapi: new Operation(
                summary: 'List categories',
                description: 'Retrieves the list of all categories available in the system.',
            )
        ),
        new Get(
            uriTemplate: '/category/{uid}',
            output: OutputDto::class,
            provider: CategoryProvider::class,
            openapi: new Operation(
                summary: 'Get category details',
                description: 'Retrieves detailed information about a specific category identified by its UID.',
            )
        ),
        new Patch(
            uriTemplate: '/category/{uid}',
            input: UpdateInputDto::class,
            processor: CategoryProcessor::class,
            provider: CategoryProvider::class,
            openapi: new Operation(
                summary: 'Update an category',
                description: 'Partially updates one or more fields of an existing category identified by its UID. Only the provided fields are modified.',
            )
        )
    ]
)]
final class CategoryApi {}
