<?php

declare(strict_types=1);

namespace App\Services\Logger;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

/**
 * Class Factory
 * @package App\Services\Logger
 */
class Factory
{
    private const LOGGER_NAME = 'API';

    /**
     * @param array<string,mixed> $parameters
     *
     * @return LoggerInterface
     */
    public function make(array $parameters): LoggerInterface
    {
        $log = new Logger(self::LOGGER_NAME);

        $level = $this->getLevelFromParameters($parameters);

        if (isset($parameters['stderr']) && ! $parameters['stderr']) {
            $this->addStderrHandler($log, $level);
        }

        if (isset($parameters['file']) && is_string($parameters['file'])) {
            $this->addFileHandler($log, $parameters['file'], $level);
        }

        return $log;
    }

    /**
     * @param array $parameters
     *
     * @return integer
     */
    protected function getLevelFromParameters(array $parameters): int
    {
        if (isset($parameters['debug'])) {
            return $parameters['debug'] ? Logger::DEBUG : Logger::INFO;
        }

        return Logger::INFO;
    }

    /**
     * @param Logger $log
     * @param integer $level
     *
     * @return void
     */
    protected function addStderrHandler(Logger $log, int $level): void
    {
        $log->pushHandler(new StreamHandler('php://stderr', $level));
    }

    /**
     * @param Logger $log
     * @param string $path
     * @param integer $level
     *
     * @return void
     */
    protected function addFileHandler(Logger $log, string $path, int $level): void
    {
        $log->pushHandler(new StreamHandler($path, $level));
    }
}
