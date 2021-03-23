<?php

declare(strict_types=1);

namespace App\Services\Config;

/**
 * Interface IConfig
 */
interface ConfigInterface
{
    /**
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null): mixed;

    /**
     * @return array
     */
    public function all(): array;
}
