<?php

namespace App\Infrastructure\EventListener;

use App\Application\Dto\ErrorResponse;
use App\Domain\Shipping\Exception\ShippingException;
use App\Domain\Shipping\Exception\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ShippingExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof ShippingException) {
            $response = new JsonResponse(new ErrorResponse(error: 'Unsupported carrier'), Response::HTTP_BAD_REQUEST);
            $event->setResponse($response);
        }

        if ($exception instanceof ValidationException) {
            $response = new JsonResponse(new ErrorResponse(error: 'Validation failed'), Response::HTTP_BAD_REQUEST);
            $event->setResponse($response);
        }
    }
}