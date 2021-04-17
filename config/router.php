<?php

declare(strict_types=1);

use App\Http\Actions\Greeting;
use App\Http\Responses\JsonResponse;
use App\Services\Router\StaticRouterGroup as Group;
use Slim\Interfaces\RouteCollectorProxyInterface;

return static function (RouteCollectorProxyInterface $router): void {
    $router->get('/', Greeting::class);

    $router->group(
        '/test',
        new Group(static function (RouteCollectorProxyInterface $router): void {
            $router->get('', static fn () => new JsonResponse('hello vlad, i love your cock'));
        })
    );
};
