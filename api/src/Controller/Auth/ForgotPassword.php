<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Repository\UserRepository;
use App\Services\ResetPassword\ResetPasswordService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

final class ForgotPassword
{
    #[Route('/api/forgot-password', name: 'forgot-password', methods: ['POST'])]
    public function __invoke(Request $request, ResetPasswordService $service, UserRepository $repository): JsonResponse
    {
        $user = $repository->findOneBy(['email' => $request->get('email')]);

        if (!$user) {
            throw new NotFoundHttpException('User not found');
        }

        $service->generateResetToken($user);

        return new JsonResponse();
    }
}
