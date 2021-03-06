<?php

declare(strict_types=1);

use App\Http\Actions\Greeting;
use Slim\Interfaces\RouteCollectorProxyInterface;

return static function (RouteCollectorProxyInterface $app) {
    $app->get('/', Greeting::class);
};
