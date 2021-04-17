<?php

declare(strict_types=1);

namespace App;

use App\Services\Config\Config;
use App\Services\Config\ConfigInterface;
use App\Services\Config\Factory;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;

/**
 * Class Kernel.
 */
final class Kernel
{
    private App $application;

    /**
     * Kernel constructor.
     */
    public function __construct(ContainerInterface $container)
    {
        $this->application = AppFactory::createFromContainer($container);
    }

    /**
     * Configure application.
     */
    public function handle(): void
    {
        /** @var ContainerInterface $container */
        $container = $this->application->getContainer();

        /** @var Config $config */
        $config = $container->get(ConfigInterface::class);

        $this->loadConfiguration($config);
        $this->configureRoutes($this->application);

        $this->application->run();
    }

    private function loadConfiguration(Config $config): void
    {
        $parameters = (new Factory())->make(\dirname(__DIR__) . '/config/packages');

        $config->setMany($parameters);
    }

    /**
     * Add routes to project.
     */
    private function configureRoutes(App $app): void
    {
        /** @psalm-suppress UnresolvableInclude */
        (require \dirname(__DIR__) . '/config/router.php')($app);
    }
}
