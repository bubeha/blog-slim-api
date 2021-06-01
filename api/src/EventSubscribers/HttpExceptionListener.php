<?php

declare(strict_types=1);

namespace App\EventSubscribers;

use App\Exceptions\ValidationException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final class HttpExceptionListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            ExceptionEvent::class => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof ValidationException) {
            $response = new JsonResponse($exception->getMessages(), Response::HTTP_UNPROCESSABLE_ENTITY);

            $event->setResponse($response);
        }
    }
}
