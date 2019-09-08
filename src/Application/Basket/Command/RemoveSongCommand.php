<?php

declare(strict_types=1);

namespace App\Application\Basket\Command;

use Assert\Assertion;
use Ramsey\Uuid\Uuid;

class RemoveSongCommand
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    public $songId;
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    public $basketId;

    public function __construct(string $songId, string $basketId)
    {
        Assertion::uuid($songId);
        Assertion::uuid($basketId);
        $this->songId = Uuid::fromString($songId);
        $this->basketId = Uuid::fromString($basketId);
    }
}