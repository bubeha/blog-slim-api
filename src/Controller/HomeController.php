<?php

declare(strict_types=1);

namespace App\Controller;

use App\Services\Config\Contract;
use Psr\Http\Message\ResponseInterface;

/**
 * Home AbstractController.
 */
class HomeController extends AbstractController
{
    /**
     * Home Action.
     *
     * @param Contract $contract
     *
     * @return ResponseInterface
     *
     * @throws \JsonException
     */
    public function home(Contract $contract): ResponseInterface
    {
        $data = $contract->get('app.name', 'test');

        return $this->json($data);
    }
}
