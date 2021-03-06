<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

/**
 * Class JsonResponse
 * @package App\Http\Responses
 */
class JsonResponse extends Response
{
    /**
     * JsonResponse constructor.
     * @param mixed $data
     * @param integer $status
     * @throws \JsonException
     */
    public function __construct(mixed $data, int $status = 200)
    {
        parent::__construct(
            $status,
            new Headers([
                'Content-Type' => 'application/json',
            ]),
            (new StreamFactory())->createStream(json_encode($data, JSON_THROW_ON_ERROR))
        );
    }
}
