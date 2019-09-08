<?php

declare(strict_types=1);


namespace App\Domain\Basket\Repository;

use App\Domain\Basket\Entity\ShoppingBasket;
use App\Domain\Item\Entity\Song;
use Doctrine\ORM\EntityManagerInterface;

class ShoppingBasketStore
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ShoppingBasketRepository
     */
    private $repository;

    public function __construct(EntityManagerInterface $entityManager, ShoppingBasketRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    public function get(string $basketId): ?ShoppingBasket
    {
        return $this->repository->find($basketId);
    }

    public function store(ShoppingBasket $basket): void
    {
        $this->entityManager->persist($basket);
        $this->entityManager->flush();
    }

    public function removeSong(ShoppingBasket $basket, Song $song): void
    {

        $basket->getItems()->removeElement($song);

        $this->entityManager->persist($basket);
        $this->entityManager->flush();
    }
}
