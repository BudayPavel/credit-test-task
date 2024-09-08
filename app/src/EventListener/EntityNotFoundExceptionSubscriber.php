<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Exception\EntityNotFoundException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class EntityNotFoundExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if (!$exception instanceof EntityNotFoundException) {
            return;
        }

        $event->setResponse(new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_NOT_FOUND));
    }
}
