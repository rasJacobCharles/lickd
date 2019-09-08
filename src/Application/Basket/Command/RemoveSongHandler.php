<?php

declare(strict_types=1);

namespace App\Application\Basket\Command;

use App\Domain\Basket\Repository\ShoppingBasketStore;
use App\Domain\Basket\Specification\InBasketSpecification;
use App\Domain\Item\Repository\SongRepository;
use App\Domain\Item\Specification\SongExistSpecification;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RemoveSongHandler
{
    /**
     * @var SongExistSpecification
     */
    private $songSpecification;

    /**
     * @var InBasketSpecification
     */
    private $basketSpecification;

    /**
     * @var ShoppingBasketStore
     */
    private $basketStore;
    /**
     * @var SongRepository
     */
    private $songRepository;

    public function __construct(
        SongExistSpecification $songSpecification,
        InBasketSpecification $basketSpecification,
        ShoppingBasketStore $basketStore,
        SongRepository $songRepository
    ) {
        $this->songSpecification = $songSpecification;
        $this->basketSpecification = $basketSpecification;
        $this->basketStore = $basketStore;
        $this->songRepository = $songRepository;
    }

    public function __invoke(RemoveSongCommand $command): void
    {
        if (!$this->songSpecification->exist($songId = $command->songId->toString()))
        {
            throw new NotFoundHttpException('Song does exist with input id');
        }

        if (
            !$this->basketSpecification->exist(
                $songId,
                $basketId = $command->basketId->toString())
        ) {
            return;
        }

        $this->basketStore->removeSong(
            $this->basketStore->get($basketId),
            $this->songRepository->find($songId)
        );
    }
}