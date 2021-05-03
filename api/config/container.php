<?php

declare(strict_types=1);

use App\Services\Config\Config;
use App\Services\Config\ConfigInterface;
use App\Services\ErrorHandler\LogErrorHandler;
use App\Services\Logger\Factory;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\ExistingConfiguration;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Metadata\Storage\TableMetadataStorageConfiguration;
use Doctrine\Migrations\Tools\Console\Command;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Log\LoggerInterface;
use Slim\App;
use Slim\CallableResolver;
use Slim\Factory\AppFactory;
use Slim\Interfaces\CallableResolverInterface;
use Slim\Middleware\ErrorMiddleware;
use Slim\Psr7\Factory\ResponseFactory;

// todo make ServiceProvider

return [
    App::class => static fn (ContainerInterface $container) => AppFactory::createFromContainer($container),
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
         * @var array{
         *      metadata_dirs: string[],
         *      dev_mode: bool,
         *      connection: array<string, mixed>,
         *      proxy_dir:string,
         *      cache_dir:?string,
         * }
         */
        $config = $config->get('doctrine');

        $setup = Setup::createAnnotationMetadataConfiguration(
            $config['metadata_dirs'],
            $config['dev_mode'],
            $config['proxy_dir'],
            // todo fix it
            $config['cache_dir'] ? new FilesystemCache($config['cache_dir']) : new ArrayCache(),
            false
        );

        return EntityManager::create(
            $config['connection'],
            $setup
        );
    },
    DependencyFactory::class => static function (ContainerInterface $container) {
        $entityManager = $container->get(EntityManagerInterface::class);

        $configuration = new Doctrine\Migrations\Configuration\Configuration();
        $configuration->addMigrationsDirectory('Migrations', dirname(__DIR__) . '/migrations');
        $configuration->setAllOrNothing(true);
        $configuration->setCheckDatabasePlatform(false);

        $storageConfiguration = new TableMetadataStorageConfiguration();
        $storageConfiguration->setTableName('migrations');

        $configuration->setMetadataStorageConfiguration($storageConfiguration);

        return DependencyFactory::fromEntityManager(
            new ExistingConfiguration($configuration),
            new ExistingEntityManager($entityManager)
        );
    },
    Command\ExecuteCommand::class => static function (ContainerInterface $container) {
        $factory = $container->get(DependencyFactory::class);

        return new Command\ExecuteCommand($factory);
    },
    Command\MigrateCommand::class => static function (ContainerInterface $container) {
        $factory = $container->get(DependencyFactory::class);

        return new Command\MigrateCommand($factory);
    },
    Command\LatestCommand::class => static function (ContainerInterface $container) {
        $factory = $container->get(DependencyFactory::class);

        return new Command\LatestCommand($factory);
    },
    Command\ListCommand::class => static function (ContainerInterface $container) {
        $factory = $container->get(DependencyFactory::class);

        return new Command\ListCommand($factory);
    },
    Command\StatusCommand::class => static function (ContainerInterface $container) {
        $factory = $container->get(DependencyFactory::class);

        return new Command\StatusCommand($factory);
    },
    Command\UpToDateCommand::class => static function (ContainerInterface $container) {
        $factory = $container->get(DependencyFactory::class);

        return new Command\UpToDateCommand($factory);
    },
    Command\DiffCommand::class => static function (ContainerInterface $container) {
        $factory = $container->get(DependencyFactory::class);

        return new Command\DiffCommand($factory);
    },
    Command\GenerateCommand::class => static function (ContainerInterface $container) {
        $factory = $container->get(DependencyFactory::class);

        return new Command\GenerateCommand($factory);
    },
];
