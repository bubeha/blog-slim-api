<?php

declare(strict_types=1);

namespace Tests\Unit\Responses;

use App\Http\Responses\JsonResponse;
use JsonException;
use Monolog\Test\TestCase;
use stdClass;

/**
 * @internal
 * @covers \App\Http\Responses\JsonResponse
 */
final class JsonResponseTest extends TestCase
{
    /**
     * @throws JsonException
     */
    public function testWidthCode(): void
    {
        $response = new JsonResponse(null, 201);

        self::assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        self::assertEquals('null', $response->getBody()->getContents());
        self::assertEquals(201, $response->getStatusCode());
    }

    /**
     * @dataProvider getCase
     * @throws JsonException
     */
    public function testResponse(mixed $source, mixed $expect): void
    {
        $response = new JsonResponse($source);

        self::assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        self::assertEquals($expect, $response->getBody()->getContents());
        self::assertEquals(200, $response->getStatusCode());
    }

    /**
     * @return array<string, array>
     */
    public function getCase(): array
    {
        $array = ['str' => 'value', 'int' => 1, 'none' => null];

        $object = new stdClass();
        $object->str = 'value';
        $object->int = 1;
        $object->none = null;

        return [
            'null' => [null, 'null'],
            'empty' => ['', '""'],
            'number' => [12, '12'],
            'string' => ['12', '"12"'],
            'array' => [$array, '{"str":"value","int":1,"none":null}'],
            'object' => [$object, '{"str":"value","int":1,"none":null}'],
        ];
    }
}
