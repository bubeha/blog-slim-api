<?php

declare(strict_types=1);

namespace App\Services\Loaders;

use Psr\Container\ContainerInterface;
use Slim\App;

final class MiddlewareLoader implements LoaderInterface
{
    public function load(ContainerInterface $container): void
    {
        $app = $container->get(App::class);

        (require \dirname(__DIR__) . '/../../config/middleware.php')($app);
    }
}
