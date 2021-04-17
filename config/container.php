<?php

declare(strict_types=1);

use App\Services\Config\Config;
use App\Services\Config\ConfigInterface;
use App\Services\Logger\Factory;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return [
    ConfigInterface::class => static fn () => new Config(),
    LoggerInterface::class => static function (ContainerInterface $container) {
        /** @var array<string,mixed> $parameters */
        $parameters = ($container->get(ConfigInterface::class))->get('logger', []);

        return (new Factory())->make($parameters);
    },
];
