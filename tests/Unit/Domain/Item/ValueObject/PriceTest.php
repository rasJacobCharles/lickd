<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Item\ValueObject;

use App\Domain\Item\ValueObject\Price;
use Assert\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    /**
     * @dataProvider validPriceDataProvider
     */
    public function testSuccessCreatePrice(string $expectedPrice): void
    {
        $this->assertInstanceOf(Price::class, $result = Price::create($expectedPrice));
        $this->assertEquals($expectedPrice, $result->amount);
    }

    /**
     * @dataProvider invalidPriceDataProvider
     */
    public function testFailureNotAValidNumber(string $errorAmount): void
    {
        $this->expectException(AssertionFailedException::class);

        Price::create($errorAmount);
    }

    public function validPriceDataProvider(): array
    {
        return [
            ['123'],
            ['1.23'],
            ['0']
        ];
    }

    public function invalidPriceDataProvider(): array
    {
        return [
            ['.123'],
            ['abc'],
            ['']
        ];
    }
}
