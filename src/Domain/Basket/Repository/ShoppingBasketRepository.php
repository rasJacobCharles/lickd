<?php

namespace App\Domain\Basket\Repository;

use App\Domain\Basket\Entity\ShoppingBasket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ShoppingBasket|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShoppingBasket|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShoppingBasket[]    findAll()
 * @method ShoppingBasket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShoppingBasketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShoppingBasket::class);
    }
}
