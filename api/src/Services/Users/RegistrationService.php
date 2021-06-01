<?php

declare(strict_types=1);

namespace App\Services\Users;

use App\Entity\User;
use App\Exceptions\ValidationException;
use App\Services\Users\Dto\UserDto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class RegistrationService
{
    public function __construct(
        private UserPasswordEncoderInterface $passwordEncoder,
        private EntityManagerInterface $entityManager,
        private ValidatorInterface $validator
    ) {
    }

    public function register(UserDto $dto): void
    {
        $errors = $this->validator->validate($dto);

        if (0 !== \count($errors)) {
            throw new ValidationException($errors);
        }

        $user = new User();

        $user->setEmail($dto->getEmail());
        $user->setPassword($this->passwordEncoder->encodePassword($user, $dto->getPassword()));

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
