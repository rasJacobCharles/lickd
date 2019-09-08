<?php

declare(strict_types=1);

namespace App\Domain\Item\ValueObject;

class Track
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var Song
     */
    public $songDetail;

    /**
     * @var Price
     */
    public $price;
}