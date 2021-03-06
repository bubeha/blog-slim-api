<?php

declare(strict_types=1);

namespace App\Services\Config;

/**
 * Class Loader
 */
class Factory
{
    /**
     * @param array $paths
     *
     * @return IConfig
     */
    public function load(array $paths = []): IConfig
    {
        $data = [];

        foreach ($paths as $path) {

        }

        return new Config();
    }
}
