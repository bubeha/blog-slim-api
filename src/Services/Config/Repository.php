<?php

declare(strict_types=1);

namespace App\Services\Config;

/**
 * Class Repository.
 */
class Repository implements Contract
{
    /** @var array */
    private array $items;

    /**
     * Repository constructor.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * {@inheritDoc}
     *
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    public function set(string $key, $value): void
    {
        $this->items[$key] = $value;
    }

    /**
     * {@inheritDoc}
     *
     * @param string $key
     * @param mixed|null $default
     *
     * @return array|mixed
     */
    public function get(string $key, $default = null)
    {
        return array_get($this->items, $key, $default);
    }
}
