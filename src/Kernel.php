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
class Kernel
{
    private App $application;

    /**
     * Kernel constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->application = AppFactory::createFromContainer($container);
    }

    /**
     * Configure application
     *
     * @return void
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

    /**
     * @param Config $config
     *
     * @return void
     */
    private function loadConfiguration(Config $config): void
    {
        $parameters = (new Factory())->make(appDirectory() . '/config/packages');

        $config->setMany($parameters);
    }

    /**
     * Add routes to project
     *
     * @param App $app
     *
     * @return void
     */
    private function configureRoutes(App $app): void
    {
        (require appDirectory() . '/config/router.php')($app);
    }
}
