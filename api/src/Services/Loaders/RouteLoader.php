<?php

declare(strict_types=1);

namespace App\Services\Loaders;

use Slim\App;

final class RouteLoader implements LoaderInterface
{
    public function load(App $application): void
    {
        (require \dirname(__DIR__) . '/../../config/router.php')($application);
    }
}
