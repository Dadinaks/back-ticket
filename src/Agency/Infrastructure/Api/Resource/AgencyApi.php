<?php

namespace Dadinaks\Agency\Infrastructure\Api\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;
use Dadinaks\Agency\Infrastructure\Api\Processor\CreateAgencyProcessor;
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
        )
    ]
)]
final class AgencyApi {}
