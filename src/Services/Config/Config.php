<?php

declare(strict_types=1);

namespace App\Services\Config;

/**
 * Class Config
 */
class Config implements ConfigInterface
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

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    public function set(string $key, $value = null): void
    {
        $this->data[$key] = $value;
    }

    /**
     * @param array<string|mixed> $values
     *
     * @return void
     */
    public function setMany(array $values): void
    {
        $this->data += $values;
    }
}
