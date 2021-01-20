<?php

declare(strict_types = 1);

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;

/**
 * Home AbstractController.
 */
class HomeController extends AbstractController
{
    /**
     * Home Action.
     *
     * @throws \JsonException
     *
     * @return ResponseInterface
     */
    public function home(): ResponseInterface
    {
        $data = 'Hello World!!';

        return $this->json($data);
    }
}
