<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ResetPasswordRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResetPasswordRepository::class)
 * @ORM\Table(name="`reset_password`")
 */
class ResetPassword
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @psalm-suppress PropertyNotSetInConstructor
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @psalm-suppress PropertyNotSetInConstructor
     */
    private string $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @psalm-suppress PropertyNotSetInConstructor
     */
    private string $token;

    /**
     * @ORM\Column(type="date_immutable", length=255, unique=true)
     * @psalm-suppress PropertyNotSetInConstructor
     */
    private DateTimeImmutable $expiresAt;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getExpiresAt(): DateTimeInterface
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(DateTimeImmutable $expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
