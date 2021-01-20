<?php

declare(strict_types = 1);

namespace App;

use DI\Bridge\Slim\Bridge;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Slim\App;

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

        $this->applyRoutes($app);

        $app->run();
    }

    /**
     * @throws \Exception
     *
     * @return ContainerInterface
     */
    private function getContainer(): ContainerInterface
    {
        $builder = new ContainerBuilder();
        $builder->enableCompilation(__DIR__ . '/../var/cache/container');
        $builder->writeProxiesToFile(true, __DIR__ . '/../var/cache/container/proxies');
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
}
