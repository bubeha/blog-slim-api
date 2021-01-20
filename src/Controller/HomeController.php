<?php

declare(strict_types = 1);

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Home Controller.
 */
class HomeController
{
    /**
     * Home Action.
     *
     * @param ResponseInterface $response Psr Response
     *
     * @return ResponseInterface
     */
    public function home(ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write('Hello world!');

        return $response;
    }
}
