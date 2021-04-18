<?php

declare(strict_types=1);

namespace App;

use App\Services\Loaders\ConfigLoader;
use App\Services\Loaders\LoaderInterface;
use App\Services\Loaders\RouteLoader;
use Exception;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;

/**
 * Class Kernel.
 */
final class Kernel
{
    private App $application;

    public function __construct(ContainerInterface $container)
    {
        $this->application = AppFactory::createFromContainer($container);
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
            new ConfigLoader(),
            new RouteLoader(),
        ];
    }

    /**
     * @throws Exception
     */
    private function load(): void
    {
        foreach ($this->getLoaders() as $loader) {
            $loader->load($this->application);
        }
    }
}
