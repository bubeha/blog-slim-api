<?php

declare(strict_types=1);

namespace App\Entities;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="articles")
 * @ORM\HasLifecycleCallbacks
 */
final class Article
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     */
    private string $slug;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private string $title;

    /**
     * @ORM\Column(type="datetime_immutable", name="created_at", nullable=true)
     */
    private ?DateTimeImmutable $createdAt = null;

    /**
     * @ORM\Column(type="datetime_immutable", name="updated_at", nullable=true)
     */
    private ?DateTimeImmutable $updatedAt = null;

    public function __construct(
        string $slug,
        string $title
    ) {
        $this->slug = $slug;
        $this->title = $title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt(): void
    {
        $this->createdAt = new DateTimeImmutable('now');
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAt(): void
    {
        $this->updatedAt = new DateTimeImmutable('now');
    }
}
