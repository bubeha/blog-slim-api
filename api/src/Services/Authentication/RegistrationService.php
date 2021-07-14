<?php

declare(strict_types=1);

namespace App\Services\Authentication;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class RegistrationService
{
    public function __construct(
        private UserPasswordEncoderInterface $passwordEncoder,
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function register(string $email, string $password): void
    {
        $user = new User();

        $user->setEmail($email);
        $user->setPassword(
            $this->passwordEncoder->encodePassword($user, $password)
        );

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
