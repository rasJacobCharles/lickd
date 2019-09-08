<?php

declare(strict_types=1);

namespace App\Domain\Item\Specification;

use App\Domain\Item\Repository\SongRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SongExistSpecification
{
    /**
     * @var SongRepository
     */
    private $songRepository;

    public function __construct(SongRepository $songRepository)
    {
        $this->songRepository = $songRepository;
    }

    public function exist(string $songId): bool
    {
        return $this->isSatisfiedBy($songId);
    }

    private function isSatisfiedBy(string $songId): bool
    {
        if (null === $this->songRepository->find($songId)) {
            throw new NotFoundHttpException('Song not found');
        }

        return true;
    }
}
