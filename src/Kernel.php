<?php

declare(strict_types=1);

namespace App;

use App\Services\Config\Contract;
use App\Services\Config\Repository;
use DI\Bridge\Slim\Bridge;
use DI\Container;
use DI\ContainerBuilder;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\App;
use Slim\Psr7\Response;

/**
 * Class Kernel.
 */
class Kernel
{
    private ContainerInterface $container;

    /**
     * @throws \Exception
     *
     * @return void
     */
    public function handle(): void
    {
        $this->container = $this->getContainer();

        $app = Bridge::create($this->container);

        $this->fillContainer($this->container);
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
     * @param App $app
     *
     * @return void
     */
    private function applyRoutes(App $app): void
    {
        require_once dirname(__DIR__) . '/config/router.php';
    }

    /**
     * @param Container $container
     *
     * @return void
     */
    private function fillContainer(Container $container): void
    {
        $container->set(ContainerInterface::class, $container);
        $container->set(Contract::class, function () {
            $aggregator = new ConfigAggregator([
                new PhpFileProvider(dirname(__DIR__) . '/config/packages/*.php'),
            ]);

            return new Repository($aggregator->getMergedConfig());
        });
        $container->set(ResponseInterface::class, new Response());
    }
}
