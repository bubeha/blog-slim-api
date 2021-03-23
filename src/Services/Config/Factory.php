<?php

declare(strict_types=1);

namespace App\Services\Config;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class Loader
 */
class Factory
{
    /**
     * @param string $directory
     *
     * @return array
     */
    public function make(string $directory): array
    {
        $parameters = [];

        /** @var SplFileInfo[] $finder */
        $finder = Finder::create()
            ->files()
            ->name('*.php')
            ->in($directory);

        foreach ($finder as $file) {
            $directory = $this->getNestedDirectory($file, $directory);

            /** @var string $realPath */
            $realPath = $file->getRealPath();

            /**
             * @psalm-suppress UnresolvableInclude
             * @var mixed[] $value
             */
            $value = require $realPath;

            $parameters[$directory . basename($realPath, '.php')] = $value;
        }

        ksort($parameters, SORT_NATURAL);

        return $parameters;
    }

    /**
     * Get the configuration file nesting path.
     *
     * @param SplFileInfo $file
     * @param string $configPath
     *
     * @return string
     */
    protected function getNestedDirectory(SplFileInfo $file, string $configPath): string
    {
        $directory = $file->getPath();

        if ($nested = trim(str_replace($configPath, '', $directory), DIRECTORY_SEPARATOR)) {
            $nested = str_replace(DIRECTORY_SEPARATOR, '.', $nested) . '.';
        }

        return $nested;
    }
}
