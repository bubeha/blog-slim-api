<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class ExampleTest extends WebTestCase
{

    public function testSomething(): void
    {
       $client = static::createClient();
       $client->request(Request::METHOD_GET, '/');

        self::assertResponseStatusCodeSame(200);
    }
}
