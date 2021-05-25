<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * @internal
 */
final class ExampleTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = self::createClient();
        $client->request(Request::METHOD_GET, '/');
        $response = $client->getResponse();

        self::assertSame(200, $response->getStatusCode());
        self::assertSame('"Maintenance mode"', $response->getContent());
    }
}
