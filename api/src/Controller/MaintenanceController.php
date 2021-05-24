<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class MaintenanceController
{
    /**
     * @Route(path="/", name="mainenance", methods={"GET"})
     */
    public function index(): Response
    {
        return new JsonResponse('Maintenance mode');
    }
}
