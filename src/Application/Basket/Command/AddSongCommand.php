<?php

declare(strict_types=1);

namespace App\Application\Basket\Command;

use Assert\Assertion;
use Ramsey\Uuid\Uuid;

class AddSongCommand
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
        Assertion::uuid($songId, 'Not a valid song id');
        Assertion::uuid($basketId, 'Not a valid basket id');
        $this->songId = Uuid::fromString($songId);
        $this->basketId = Uuid::fromString($basketId);
    }
}