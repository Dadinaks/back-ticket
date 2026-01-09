<?php

namespace Dadinaks\Agency\Infrastructure\Api\EventListener;

use ApiPlatform\Validator\Exception\ValidationException;
use Dadinaks\Agency\Adapter\Interface\AgencyPresenterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

/**
 * This class intercepts exceptions returned by the API Platform or those from the Domain (DomainException),
 * and formats them using the functions of AgencyPresenterInterface.
 * @author Dadinaks Cedrick <cedrick.henintsoa.8821@gmail.com>
 */
final class ApiExceptionListener
{
    public function __construct(
        private AgencyPresenterInterface $presenter
    ) {}

    public function __invoke(ExceptionEvent $event): void
    {
        $e = $event->getThrowable();

        // 1️⃣ Validation API Platform (422)
        if ($e instanceof ValidationException) {
            $violations = $e->getConstraintViolationList();

            $message = $violations->count() > 0
                ? $violations[0]->getMessage()
                : 'Validation error.';

            $this->respond($event, 422, $message);
            return;
        }

        // 2️⃣ Erreurs métier (Domain)
        if ($e instanceof \DomainException) {
            $this->respond($event, 409, $e->getMessage());
            return;
        }

        // 3️⃣ Exceptions HTTP Symfony (401, 403, 404…)
        if ($e instanceof HttpExceptionInterface) {
            $this->respond(
                $event,
                $e->getStatusCode(),
                $e->getMessage()
            );
            return;
        }

        // 4️⃣ Erreur inconnue (500)
        $this->respond(
            $event,
            500,
            'Internal server error.'
        );
    }

    private function respond(ExceptionEvent $event, int $statusCode, string $message): void
    {
        $event->setResponse(
            new JsonResponse(
                $this->presenter->presentError(
                    $statusCode,
                    $message,
                    []
                ),
                $statusCode
            )
        );
    }
}
