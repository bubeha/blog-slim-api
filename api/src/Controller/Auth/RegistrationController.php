<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Services\Users\Dto\UserDto;
use App\Services\Users\RegistrationService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class RegistrationController
{
    public function __construct(private RegistrationService $service)
    {
    }

    #[Route('/api/registration', name: 'registration', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $email = (string)$request->get('email');
        $password = (string)$request->get('password');

        $this->service->register(
            new UserDto($email, $password)
        );

        return new JsonResponse('done');
    }
}
