<?php

declare(strict_types=1);

namespace App\Domain\Basket\Factory;

use App\Domain\Item\Entity\Song;
use App\Domain\Item\ValueObject\Price;
use Assert\AssertionFailedException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

class BasketTotalFactory
{
    /**
     * @param ArrayCollection| PersistentCollection $collection
     *
     * @throws AssertionFailedException
     */
    public static function getTotal($collection) :  array
    {
        $total = [];
        foreach ($collection as $value) {
            if ($value instanceof Song) {
               $total[] = $value->getPrice();
            }
        }

        return ['total' => (string) Price::create((string)array_sum($total))];
    }
}