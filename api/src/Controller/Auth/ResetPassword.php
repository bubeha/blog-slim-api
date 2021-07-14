<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Repository\ResetPasswordRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ResetPassword
{
    #[Route('/api/reset-password/{token}', name: 'reset-password', methods: ['POST'])]
    public function __invoke(string $token, ResetPasswordRepository $resetPasswordRepository, UserRepository $userRepository)
    {
        $entity = $resetPasswordRepository->findOneBy(['token' => $token]);

        if (! $entity) {
            throw new NotFoundHttpException();
        }

        $user = $userRepository->findOneBy(['email' => $entity->getEmail()]);

        // todo add code for update password
    }
}
