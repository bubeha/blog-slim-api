<?php

declare(strict_types=1);

namespace App;

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
        $this->configureRoutes($this->application);

        $this->application->run();
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
        (require dirname(__DIR__) . '/config/router.php')($app);
    }
}
