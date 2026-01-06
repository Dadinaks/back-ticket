<?php

namespace Dadinaks\Agency\Infrastructure\Api\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;
use Dadinaks\Agency\Infrastructure\Api\Processor\CreateAgencyProcessor;
use Dadinaks\Agency\Infrastructure\Api\Provider\AgencyProvider;
use Dadinaks\Agency\InterfaceAdapter\Dto\InputDto;
use Dadinaks\Agency\InterfaceAdapter\Dto\OutputDto;

#[ApiResource(
    shortName: 'Agency',
    description: 'Agency resource',
    uriTemplate: '/agencies',
    operations: [
        new Post(
            input: InputDto::class,
            output: OutputDto::class,
            processor: CreateAgencyProcessor::class,
            openapi: new Operation(
                summary: 'Create a new agency',
                description: 'Add new agency to the system',
            )
        ),
        new GetCollection(
            output: OutputDto::class,
            provider: AgencyProvider::class,
            openapi: new Operation(
                summary: 'List all agencies',
                description: 'Retrieve a list of all agencies in the system',
            )
        ),
        new Get(
            uriTemplate: '/agency/{uid}',
            output: OutputDto::class,
            provider: AgencyProvider::class,
            openapi: new Operation(
                summary: 'Agency details',
                description: 'Retrieve details of a specific agency by its UID',
            )
        ),
    ]
)]
final class AgencyApi {}
