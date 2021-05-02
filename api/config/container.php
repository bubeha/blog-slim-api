<?php

declare(strict_types=1);

use App\Services\Config\Config;
use App\Services\Config\ConfigInterface;
use App\Services\ErrorHandler\LogErrorHandler;
use App\Services\Logger\Factory;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Log\LoggerInterface;
use Slim\CallableResolver;
use Slim\Interfaces\CallableResolverInterface;
use Slim\Middleware\ErrorMiddleware;
use Slim\Psr7\Factory\ResponseFactory;

return [
    ConfigInterface::class => static fn () => new Config(),
    LoggerInterface::class => static function (ContainerInterface $container) {
        /** @var array<string,mixed> $parameters */
        $parameters = ($container->get(ConfigInterface::class))->get('logger', []);

        return (new Factory())->make($parameters);
    },
    CallableResolverInterface::class => static fn (
        ContainerInterface $container
    ): CallableResolverInterface => new CallableResolver($container),
    ResponseFactoryInterface::class => static fn (): ResponseFactoryInterface => new ResponseFactory(),
    ErrorMiddleware::class => static function (ContainerInterface $container) {
        $callableResolver = $container->get(CallableResolverInterface::class);
        $responseFactory = $container->get(ResponseFactoryInterface::class);
        $config = $container->get(ConfigInterface::class);

        $middleware = new ErrorMiddleware(
            $callableResolver,
            $responseFactory,
            (bool)$config->get('errors.display_details', false),
            true,
            true
        );

        $logger = $container->get(LoggerInterface::class);

        $middleware->setDefaultErrorHandler(
            new LogErrorHandler($callableResolver, $responseFactory, $logger)
        );

        return $middleware;
    },
    EntityManagerInterface::class => static function (ContainerInterface $container) {
        $config = $container->get(ConfigInterface::class);

        /**
         * @var array{metadata_dirs: string[], dev_mode: bool, connection: array<string, mixed>}
         */
        $config = $config->get('doctrine');

        $setup = Setup::createAnnotationMetadataConfiguration(
            $config['metadata_dirs'],
            $config['dev_mode'],
        );

        return EntityManager::create(
            $config['connection'],
            $setup
        );
    },
];
