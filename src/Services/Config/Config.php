<?php

declare(strict_types=1);

namespace App\Services\Config;

/**
 * Class Config.
 */
final class Config implements ConfigInterface
{
    private array $data = [];

    /**
     * Config constructor.
     *
     * @param array<string, mixed> $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function get(string $key, $default = null): mixed
    {
        if (\array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        return $default;
    }

    public function all(): array
    {
        return $this->data;
    }

    /**
     * @param mixed|null $value
     */
    public function set(string $key, $value = null): void
    {
        $this->data[$key] = $value;
    }

    /**
     * @param array<mixed|string> $values
     */
    public function setMany(array $values): void
    {
        $this->data += $values;
    }
}
