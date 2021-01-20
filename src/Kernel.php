<?php

declare(strict_types = 1);

namespace App;

use DI\Bridge\Slim\Bridge;
use DI\Container;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\App;
use Slim\Psr7\Response;

/**
 * Class Kernel.
 */
class Kernel
{
    /**
     * @throws \Exception
     */
    public function handle(): void
    {
        $container = $this->getContainer();

        $app = Bridge::create($container);

        $this->fillContainer($container);

        $this->applyRoutes($app);

        $app->run();
    }

    /**
     * @throws \Exception
     *
     * @return Container
     */
    private function getContainer(): Container
    {
        $builder = new ContainerBuilder();
        $builder->useAutowiring(true);
        $builder->useAnnotations(false);

        return $builder->build();
    }

    /**
     * @param App $app Slim Application
     */
    private function applyRoutes(App $app): void
    {
        require_once __DIR__ . '/../config/router.php';
    }

    /**
     * @param Container $container Psr Container
     */
    private function fillContainer(Container $container): void
    {
        $container->set(ContainerInterface::class, $container);
        $container->set(ResponseInterface::class, new Response());
    }
}
