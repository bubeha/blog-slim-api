<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/api/me', name: 'me', methods: ['GET'])]
    public function index(): JsonResponse {
        $user = $this->getUser();

        return new JsonResponse([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
        ]);
    }
}
