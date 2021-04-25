<?php

declare(strict_types=1);

namespace App\Services\Loaders;

use App\Services\Config\ConfigInterface;
use Psr\Container\ContainerInterface;
use Slim\App;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

final class ConfigLoader implements LoaderInterface
{
    public function load(App $application): void
    {
        /** @var ContainerInterface $container */
        $container = $application->getContainer();
        $config = $container->get(ConfigInterface::class);

        $config->setMany(
            $this->getParameters(\dirname(__DIR__) . '/../../config/packages/')
        );
    }

    private function getParameters(string $directory): array
    {
        $parameters = [];

        /** @var SplFileInfo[] $finder */
        $finder = Finder::create()
            ->files()
            ->name('*.php')
            ->in($directory)
        ;

        foreach ($finder as $file) {
            $directory = $this->getNestedDirectory($file, $directory);

            /** @var string $realPath */
            $realPath = $file->getRealPath();

            /**
             * @psalm-suppress UnresolvableInclude
             *
             * @var array $value
             */
            $value = require $realPath;

            $parameters[basename($realPath, '.php')] = $value;
        }

        ksort($parameters, SORT_NATURAL);

        return $parameters;
    }

    /**
     * Get the configuration file nesting path.
     */
    private function getNestedDirectory(SplFileInfo $file, string $configPath): string
    {
        $directory = $file->getPath();

        if ($nested = trim(str_replace($configPath, '', $directory), \DIRECTORY_SEPARATOR)) {
            $nested = str_replace(\DIRECTORY_SEPARATOR, '.', $nested) . '.';
        }

        return $nested;
    }
}
