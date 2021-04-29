<?php

declare(strict_types=1);

if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param mixed $value
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('array_get')) {
    /**
     * Get an item from an array using "dot" notation.
     *
     * @param array<string,mixed> $array
     * @param mixed|null          $default
     */
    function array_get(array $array, string $key, $default = null): mixed
    {
        if (isset($array[$key])) {
            return $array[$key];
        }

        foreach (explode('.', $key) as $segment) {
            if (!is_array($array) || !array_key_exists($segment, $array)) {
                return value($default);
            }

            /** @var mixed $array */
            $array = $array[$segment];
        }

        return $array;
    }
}

if (!function_exists('env')) {
    function env(string $key, $default = null): mixed
    {
        if (!array_key_exists($key, $_ENV)) {
            return $default;
        }

        return match ($_ENV[$key]) {
            'true' => true,
            'false' => false,
            '', 'null' => null,
            default => $_ENV[$key],
        };
    }
}