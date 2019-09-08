<?php

declare(strict_types=1);

namespace App\Application\Basket\Command;

use Assert\Assertion;
use Ramsey\Uuid\Uuid;

class GetBasketCommand
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    public $basketId;

    public function __construct(string $basketId)
    {
        Assertion::uuid($basketId);
        $this->basketId = Uuid::fromString($basketId);
    }
}