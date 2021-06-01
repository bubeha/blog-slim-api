<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class ForgotPassword
{
    #[Route('/api/forgot-password', name: 'forgot-password', methods: ["POST"])]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse();
    }
}
