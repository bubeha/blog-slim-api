<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ResetPassword;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method \App\Entity\User|null find($id, $lockMode = null, $lockVersion = null)
 * @method \App\Entity\User|null findOneBy(array $criteria, array $orderBy = null)
 * @method list<\App\Entity\ResetPassword> findAll()
 * @method list<\App\Entity\ResetPassword> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ResetPasswordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResetPassword::class);
    }
}
