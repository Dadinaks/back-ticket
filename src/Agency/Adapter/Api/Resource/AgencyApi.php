<?php

namespace Dadinaks\Agency\Adapter\Api\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;
use Dadinaks\Agency\Adapter\Api\Processor\AgencyProcessor;
use Dadinaks\Agency\Adapter\Api\Provider\AgencyProvider;
use Dadinaks\Agency\Adapter\Dto\InputDto;
use Dadinaks\Agency\Adapter\Dto\OutputDto;
use Dadinaks\Agency\Adapter\Dto\UpdateInputDto;

#[ApiResource(
    shortName: 'Agency',
    description: 'Agency management resource',
    uriTemplate: '/agencies',
    operations: [
        new Post(
            input: InputDto::class,
            output: OutputDto::class,
            processor: AgencyProcessor::class,
            openapi: new Operation(
                summary: 'Create an agency',
                description: 'Creates a new agency and stores it in the system.',
            )
        ),
        new GetCollection(
            output: OutputDto::class,
            provider: AgencyProvider::class,
            openapi: new Operation(
                summary: 'List agencies',
                description: 'Retrieves the list of all agencies available in the system.',
            )
        ),
        new Get(
            uriTemplate: '/agency/{uid}',
            output: OutputDto::class,
            provider: AgencyProvider::class,
            openapi: new Operation(
                summary: 'Get agency details',
                description: 'Retrieves detailed information about a specific agency identified by its UID.',
            )
        ),
        new Patch(
            uriTemplate: '/agency/{uid}',
            input: UpdateInputDto::class,
            processor: AgencyProcessor::class,
            openapi: new Operation(
                summary: 'Update an agency',
                description: 'Partially updates one or more fields of an existing agency identified by its UID. Only the provided fields are modified.',
            )
        )
    ]
)]
final class AgencyApi {}
