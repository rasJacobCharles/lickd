<?php

declare(strict_types=1);

namespace App\Application\Basket\Command;

use App\Domain\Basket\Repository\ShoppingBasketStore;
use App\Domain\Basket\Specification\InBasketSpecification;
use App\Domain\Item\Repository\SongRepository;
use App\Domain\Item\Specification\SongExistSpecification;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AddSongHandler
{
    /**
     * @var SongExistSpecification
     */
    private $specification;

    /**
     * @var ShoppingBasketStore
     */
    private $basketRepository;

    /**
     * @var SongRepository
     */
    private $songRepository;
    /**
     * @var InBasketSpecification
     */
    private $basketSpecification;

    public function __construct(
        SongExistSpecification $songSpecification,
        InBasketSpecification $basketSpecification,
        ShoppingBasketStore $repository,
        SongRepository $songRepository
    )
    {
        $this->specification = $songSpecification;
        $this->basketSpecification = $basketSpecification;
        $this->basketRepository = $repository;
        $this->songRepository = $songRepository;
    }

    public function __invoke(AddSongCommand $command): void
    {
        if (!$this->specification->exist($command->songId->toString())) {
            throw new NotFoundHttpException('Song Id does match exist song');
        }

        if(!$basket = $this->basketRepository->get($command->basketId->toString())) {
            throw new NotFoundHttpException('Basket Id does match exist basket');
        }
        $basket->getItems()->add($this->songRepository->find($command->songId->toString()));
        if(!$this->basketSpecification->exist($command->songId->toString(), $command->basketId->toString())){
            $this->basketRepository->store($basket);
        }
    }
}