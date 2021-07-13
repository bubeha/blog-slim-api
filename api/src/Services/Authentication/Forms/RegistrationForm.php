<?php

declare(strict_types=1);

namespace App\Services\Authentication\Forms;

use App\Entity\User;
use App\Services\FormRequest\FormRequestContract;
use App\Validator\Constraint\UniqueValue;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @psalm-immutable
 */
final class RegistrationForm implements FormRequestContract
{
    #[Assert\NotBlank]
    #[Assert\Email()]
    #[Assert\Length(min: 4, max: 255)]
    #[UniqueValue(entityClass: User::class, field: 'email')]
    private string $email;

    #[Assert\NotBlank]
    #[Assert\Length(min: 6, max: 20)]
    private string $password;

    /**
     * @psalm-suppress ImpureMethodCall
     */
    public function __construct(Request $request)
    {
        $this->email = (string)($request->get('email'));
        $this->password = (string)($request->get('password'));
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
