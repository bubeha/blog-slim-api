<?php

declare(strict_types=1);

namespace App\Services\Loaders;

use App\Services\Config\ConfigInterface;
use App\Services\Config\Provider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Psr\Container\ContainerInterface;

final class ConfigLoader implements LoaderInterface
{
    /** @var array<string> */
    private array $patterns;

    /**
     * @param array<string> $patterns
     */
    public function __construct(array $patterns = [])
    {
        $this->patterns = $patterns;
    }

    public function load(ContainerInterface $container): void
    {
        $config = $container->get(ConfigInterface::class);

        $aggregator = new ConfigAggregator(
            $this->getProviders()
        );

        $config->setMany(
            $aggregator->getMergedConfig()
        );
    }

    /**
     * @return \App\Services\Config\Provider[]
     */
    private function getProviders(): array
    {
        $providers = [];

        foreach ($this->patterns as $directory) {
            $providers[] = new Provider($directory);
        }

        return $providers;
    }
}
