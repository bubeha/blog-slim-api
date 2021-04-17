<?php

declare(strict_types=1);

namespace App\Services\Router;

use Slim\Routing\RouteCollectorProxy;

final class StaticRouterGroup
{
    private $callable;

    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    public function __invoke(RouteCollectorProxy $group): mixed
    {
        return ($this->callable)($group);
    }
}
