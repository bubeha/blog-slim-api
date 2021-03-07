<?php

declare(strict_types=1);

namespace App\Services\Config;

/**
 * Class Config
 */
class Config implements IConfig
{
    protected array $data = [];

    /**
     * Config constructor.
     *
     * @param array<string, mixed> $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $key, $default = null): mixed
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        return $default;
    }

    /**
     * {@inheritDoc}
     */
    public function all(): array
    {
        return $this->data;
    }
}
