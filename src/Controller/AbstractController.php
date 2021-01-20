<?php

declare(strict_types = 1);

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;

/**
 * Class AbstractController.
 */
abstract class AbstractController
{
    /** @var ResponseInterface */
    private ResponseInterface $response;

    /**
     * AbstractController constructor.
     * @param \Psr\Http\Message\ResponseInterface $response Psr-7 Response Interface
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @param string|array $data Data to json
     * @param int $status Http Status
     * @return ResponseInterface
     * @throws \JsonException
     */
    protected function json(array|string $data, int $status = 200): ResponseInterface
    {
        $data = json_encode($data, JSON_THROW_ON_ERROR);

        $this->response
            ->getBody()
            ->write($data);

        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }
}
