<?php

declare(strict_types=1);

namespace App\Services\ResetPassword;

use App\Entity\ResetPassword;
use App\Services\ResetPassword\Generators\Generator;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class ResetPasswordService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private Generator $generator,
        private string $hashKey,
        private int $resetLifetime
    ) {
    }

    public function generateResetToken(UserInterface $user): void
    {
        $this->create($user);
    }

    public function create(UserInterface $user): ResetPassword
    {
        $this->deleteExisting($user);

        $token = $this->createNewToken();

        return $this->saveToken($user, $token);
    }

    private function deleteExisting(UserInterface $user): void
    {
        $builder = $this->entityManager->createQueryBuilder();

        $query = $builder->delete(ResetPassword::class, 'rp')
            ->where('rp.email = :email')
            ->setParameter('email', $user->getUsername())
            ->getQuery()
        ;

        $query->execute();
    }

    private function createNewToken(): string
    {
        return hash_hmac('sha256', $this->generator->generate(40), $this->hashKey);
    }

    private function saveToken(UserInterface $user, string $token): ResetPassword
    {
        $entity = new ResetPassword();

        $entity->setEmail($user->getUsername());
        $entity->setExpiresAt(new DateTimeImmutable("{$this->resetLifetime} seconds"));
        $entity->setToken($token);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }
}
