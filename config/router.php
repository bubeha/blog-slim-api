<?php

declare(strict_types=1);

use App\Http\Actions\Greeting;
use Slim\Interfaces\RouteCollectorProxyInterface;

return static function (RouteCollectorProxyInterface $router) {
    $router->get('/', Greeting::class);

    $router->group('/test', function (RouteCollectorProxyInterface $router) {
        $router->get('', function () {
            return new \App\Http\Responses\JsonResponse('hello vlad, i love your cock');
        });
    });
};
