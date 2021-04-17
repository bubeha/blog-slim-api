<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Responses\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Greeting.
 */
final class Greeting
{
    private LoggerInterface $logger;

    /**
     * Greeting constructor.
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(): ResponseInterface
    {
        $this->logger->info('hello vlad');

        return new JsonResponse('Hello World');
    }
}
