<?php

declare(strict_types=1);

namespace App\EventSubscribers;

use App\Exceptions\ValidationException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleErrorEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class ConsoleExceptionListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            ConsoleEvents::ERROR => 'onConsoleException',
        ];
    }

    public function onConsoleException(ConsoleErrorEvent $event): void
    {
        $error = $event->getError();
        if ($error instanceof ValidationException) {
            foreach ($error->getMessages() as $key => $value) {
                $message = implode('. ', $value);
                $event->getOutput()->writeln("<error>{$key}: {$message}</error>");
            }

            $event->setExitCode(Command::FAILURE);
        }
    }
}
