<?php

declare(strict_types=1);

namespace App\Services\ServiceProviders;

use Psr\Container\ContainerInterface;

interface ServiceProvider
{
    public function provide(ContainerInterface $container): void;
}
