<?php

declare(strict_types=1);


namespace App\Domain\Basket\Specification;


use App\Domain\Basket\Repository\ShoppingBasketRepository;
use App\Domain\Item\Repository\SongRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class InBasketSpecification
{
    /**
     * @var SongRepository
     */
    private $songRepository;
    /**
     * @var ShoppingBasketRepository
     */
    private $basketRepository;

    public function __construct(SongRepository $songRepository, ShoppingBasketRepository $basketRepository)
    {
        $this->songRepository = $songRepository;
        $this->basketRepository = $basketRepository;
    }

    public function exist(string $songId, string $basketId): bool
    {
        return $this->isSatisfiedBy($songId, $basketId);
    }

    private function isSatisfiedBy(string $songId, string $basketId): bool
    {
        $basket = $this->basketRepository->find($basketId);

        if (null === $basket) {
            throw new NotFoundHttpException('Basket not found');
        }
        foreach ($basket->getItems() as $item) {
            if ($item->getId() === $songId) {
                return true;
            }
        }

        return false;
    }
}
