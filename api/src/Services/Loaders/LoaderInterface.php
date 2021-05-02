<?php

declare(strict_types=1);

namespace App\Services\Loaders;

use Psr\Container\ContainerInterface;

interface LoaderInterface
{
    public function load(ContainerInterface $container): void;
}
