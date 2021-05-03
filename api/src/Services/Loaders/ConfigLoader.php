<?php

declare(strict_types=1);

namespace App\Services\Loaders;

use App\Services\Config\ConfigInterface;
use App\Services\Config\Provider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Psr\Container\ContainerInterface;

final class ConfigLoader implements LoaderInterface
{
    public function load(ContainerInterface $container): void
    {
        $config = $container->get(ConfigInterface::class);

        $directory = \dirname(__DIR__) . '/../../config/packages';

        // todo load
        $environment = getenv('APP_ENV') ?: 'prod';

        $aggregator = new ConfigAggregator([
            new Provider("{$directory}/*php"),
            new Provider("{$directory}/{$environment}/*php"),
        ]);

        $config->setMany(
            $aggregator->getMergedConfig()
        );
    }
}
