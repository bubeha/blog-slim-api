<?php

declare(strict_types=1);

namespace App\Services\Config;

use Generator;
use Laminas\ConfigAggregator\GlobTrait;

final class Provider
{
    use GlobTrait;

    private string $pattern;

    public function __construct(string $pattern)
    {
        $this->pattern = $pattern;
    }

    public function __invoke(): Generator
    {
        /** @var array<string> $glob */
        $glob = $this->glob($this->pattern);

        foreach ($glob as $file) {
            /** @psalm-suppress UnresolvableInclude */
            yield [basename($file, '.php') => include $file];
        }
    }
}
