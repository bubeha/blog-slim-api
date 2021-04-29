<?php

declare(strict_types=1);

namespace App\Services\Loaders;

use Slim\App;

final class MiddlewareLoader implements LoaderInterface
{
    public function load(App $application): void
    {
        (require \dirname(__DIR__) . '/../../config/middleware.php')($application);
    }
}
