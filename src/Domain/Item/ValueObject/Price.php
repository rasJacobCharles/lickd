<?php

declare(strict_types=1);

namespace App\Domain\Item\ValueObject;

use Assert\Assertion;
use Assert\AssertionFailedException;

class Price
{
    private const MONEY_REGEX = '/^(\d{1,3}(\,\d{3})*|(\d+))(\.\d{2})?$/';
    /**
     * @var string
     */
    public $amount;

    private function __construct(string $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @throws AssertionFailedException
     */
    public static function create(string $amount): Price
    {
        Assertion::regex($amount, self::MONEY_REGEX, 'Value is not an amount');

        return new self($amount);
    }

    public function __toString(): string
    {
        return $this->amount;
    }
}