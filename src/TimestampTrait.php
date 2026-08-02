<?php

namespace YourCompany\DoctrineTools;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait TimestampTrait
{
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?DateTimeImmutable $createdAt = null {
        get {
            return $this->createdAt;
        }
    }

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?DateTimeImmutable $modifiedAt = null {
        get {
            return $this->modifiedAt;
        }
    }

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
}