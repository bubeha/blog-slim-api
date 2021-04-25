<?php

declare(strict_types=1);

namespace App\Services\Config;

/**
 * Interface IConfig.
 */
interface ConfigInterface
{
    /**
     * @param mixed|null $default
     */
    public function get(string $key, $default = null): mixed;

    public function all(): array;

    public function set(string $key, mixed $value): self;

    public function setMany(array $values): self;
}
