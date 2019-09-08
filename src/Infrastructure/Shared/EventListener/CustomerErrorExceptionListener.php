<?php

declare(strict_types=1);


namespace App\Infrastructure\Shared\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Assert\AssertionFailedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CustomerErrorExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getException();

        $message = 'Error: Service Error';
        $response = new Response();
        $response->setStatusCode(500);

        var_dump($exception->getMessage());
        if ($exception instanceof AssertionFailedException) {
            $response->setStatusCode(400);
            $message = sprintf('Error: %s', $exception->getMessage());
        }

        if ($exception instanceof NotFoundHttpException) {
            $response->setStatusCode(404);
            $message = sprintf('Error:  %s.', $exception->getMessage());
        }

        $response->setContent(json_encode(['error' => $message], JSON_UNESCAPED_SLASHES));
        $event->setResponse($response);
    }
}