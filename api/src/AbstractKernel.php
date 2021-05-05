<?php

declare(strict_types=1);

namespace App;

use App\Services\Loaders\ConfigLoader;
use App\Services\Loaders\LoaderInterface;
use App\Services\Loaders\MiddlewareLoader;
use App\Services\Loaders\RouteLoader;
use Exception;
use Psr\Container\ContainerInterface;
use Slim\App;

/**
 * Class Kernel.
 */
abstract class AbstractKernel
{
    private App $application;
    private string $environment;

    public function __construct(string $environment, ContainerInterface $container)
    {
        $this->application = $container->get(App::class);
        $this->environment = $environment;
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $this->load();

        $this->application->run();
    }

    /**
     * @return array<LoaderInterface>
     */
    public function getLoaders(): array
    {
        return [
            new ConfigLoader([
                \dirname(__DIR__) . '/config/packages/*.php',
                \dirname(__DIR__) . "/config/packages/{$this->environment}/*.php",
            ]),
        ];
    }

    /**
     * @throws Exception
     */
    private function load(): void
    {
        /** @var ContainerInterface $container */
        $container = $this->application->getContainer();

        foreach ($this->getLoaders() as $loader) {
            $loader->load($container);
        }
    }
}
