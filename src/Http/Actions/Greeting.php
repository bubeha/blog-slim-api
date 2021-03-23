<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Responses\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Greeting
 */
class Greeting
{
    /** @var LoggerInterface */
    private LoggerInterface $logger;

    /**
     * Greeting constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return ResponseInterface
     */
    public function __invoke(): ResponseInterface
    {
        $this->logger->info('hello vlad');

        return new JsonResponse('Hello World');
    }
}
