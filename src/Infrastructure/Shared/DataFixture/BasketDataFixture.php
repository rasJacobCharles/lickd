<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\DataFixture;

use App\Domain\Basket\Entity\ShoppingBasket;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BasketDataFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $basket = new ShoppingBasket();
        $basket->setName('testBasket');

        $manager->persist($basket);
        $manager->flush();
    }
}