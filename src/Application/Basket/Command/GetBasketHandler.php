<?php

declare(strict_types=1);

namespace App\Application\Basket\Command;

use App\Domain\Basket\Entity\ShoppingBasket;
use App\Domain\Basket\Factory\BasketTotalFactory;
use App\Domain\Basket\Repository\ShoppingBasketRepository;
use App\Domain\Item\Factory\TrackFactory;
use Assert\AssertionFailedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetBasketHandler
{
    /**
     * @var ShoppingBasketRepository
     */
    private $repository;

    public function __construct(ShoppingBasketRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws AssertionFailedException
     */
    public function __invoke(GetBasketCommand $command): array
    {
        if (($basket = $this->repository->find($command->basketId)) instanceof  ShoppingBasket) {

            /** @var ShoppingBasket $basket */
            $total = BasketTotalFactory::getTotal($basketItem = $basket->getItems());
            $collection = [];
            foreach ($basketItem->toArray() as $song)
            {
                $collection['items'][] = TrackFactory::create($song);
            }

            return array_merge($total, $collection);
        }

        throw new NotFoundHttpException('Basket does not exist');
    }
}