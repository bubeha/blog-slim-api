<?php

declare(strict_types=1);

namespace Tests\Unit\Router;

use App\Services\Router\StaticRouterGroup;
use PHPUnit\Framework\TestCase;
use Slim\Routing\RouteCollectorProxy;

/**
 * @internal
 * @covers \App\Services\Router\StaticRouterGroup
 */
final class StaticRouteGroupTest extends TestCase
{
    public function testSuccess(): void
    {
        $collector = $this->createStub(RouteCollectorProxy::class);

        $callable = static fn (RouteCollectorProxy $collector): RouteCollectorProxy => $collector;

        $group = new StaticRouterGroup($callable);

        self::assertSame($collector, $group($collector));
    }
}
