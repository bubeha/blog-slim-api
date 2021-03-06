<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Responses\JsonResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Greeting
 */
class Greeting
{
    /**
     * @return ResponseInterface
     */
    public function __invoke(): ResponseInterface
    {
        return new JsonResponse('Hello World');
    }
}
