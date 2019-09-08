<?php

declare(strict_types=1);

namespace App\Application\Item\Command;

use App\Domain\Item\Factory\TrackFactory;
use App\Domain\Item\Repository\SongRepository;

class ListSongsHandler
{
    /**
     * @var SongRepository
     */
    private $repository;

    public function __construct(SongRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        $collection = [];
       foreach ($this->repository->findAll() as $song)
       {
           $collection[] = TrackFactory::create($song);
       }

       return $collection;
    }
}
