<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Services\Authentication\Forms\RegistrationForm;
use App\Services\Authentication\RegistrationService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class RegistrationController
{
    public function __construct(private RegistrationService $service)
    {
    }

    #[Route('/api/registration', name: 'registration', methods: ['POST'])]
    public function __invoke(
        RegistrationForm $request
    ): JsonResponse {
        $this->service
            ->register(
                $request->getEmail(),
                $request->getPassword()
            )
        ;

        return new JsonResponse('done');
    }
}
