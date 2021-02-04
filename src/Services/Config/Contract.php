<?php

declare(strict_types=1);

namespace App\Services\Config;

/**
 * Interface Contract.
 */
interface Contract
{
    /**
     * Set config values.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    public function set(string $key, $value): void;

    /**
     * Get config Value.
     *
     * @param string $key
     * @param mixed|null $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null);
}
