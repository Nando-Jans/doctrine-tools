<?php

namespace NandoJans\DoctrineTools;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait TimestampTrait
{
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?DateTimeImmutable $modifiedAt = null;

    #[ORM\PrePersist]
    public function initializeTimestamps(): void
    {
        $now = new DateTimeImmutable();

        $this->createdAt ??= $now;
        $this->modifiedAt ??= $now;
    }

    #[ORM\PreUpdate]
    public function updateModifiedAt(): void
    {
        $this->modifiedAt = new DateTimeImmutable();
    }

    /**
     * @param DateTimeImmutable|null $createdAt
     */
    public function setCreatedAt(?DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getModifiedAt(): ?DateTimeImmutable
    {
        return $this->modifiedAt;
    }
}