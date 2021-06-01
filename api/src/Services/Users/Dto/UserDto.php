<?php

declare(strict_types=1);

namespace App\Services\Users\Dto;

use App\Entity\User;
use App\Validator\Constraint\UniqueValue;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @psalm-immutable
 */
final class UserDto
{
    #[Assert\NotBlank]
    #[Assert\Email()]
    #[Assert\Length(min: 4, max: 255)]

    #[UniqueValue(entityClass: User::class, field: 'email')]
    private string $email;

    #[Assert\NotBlank]
    #[Assert\Length(min: 6, max: 20)]
    private string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
