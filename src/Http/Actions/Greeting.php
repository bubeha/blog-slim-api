<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Responses\JsonResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Greeting.
 */
final class Greeting
{
    public function __invoke(): ResponseInterface
    {
        return new JsonResponse('Hello World');
    }
}
