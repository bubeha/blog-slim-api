<?php

declare(strict_types=1);

namespace App\Services\Users\Dto;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @psalm-immutable
 */
class UserDto
{
    #[Assert\NotBlank]
    #[Assert\Email()]
    #[Assert\Length(min: 4, max: 255)]
    private string $email;

    #[Assert\NotBlank]
    #[Assert\Length(min: 6, max: 20)]
    private string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function __toString(): string
    {
        return '123';
    }
}
