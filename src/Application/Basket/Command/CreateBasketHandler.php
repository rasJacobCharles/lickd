<?php

declare(strict_types=1);


namespace App\Application\Basket\Command;


use App\Domain\Basket\Entity\ShoppingBasket;
use App\Domain\Basket\Repository\ShoppingBasketStore;

class CreateBasketHandler
{
    /**
     * @var ShoppingBasketStore
     */
    private $basketStore;

    public function __construct(ShoppingBasketStore $basketStore)
    {
        $this->basketStore = $basketStore;
    }

    public function __invoke():string
    {
        $this->basketStore->store($basket = new ShoppingBasket());

        return $basket->getId();
    }
}