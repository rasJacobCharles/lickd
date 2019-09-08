<?php

declare(strict_types=1);

namespace App\Domain\Item\Factory;

use App\Domain\Item\Entity\Song;
use App\Domain\Item\ValueObject\Song as SongDetail;
use App\Domain\Item\ValueObject\Track;

class TrackFactory
{
    public static function create(Song $song): Track
    {
        $track = new Track();
        $track->id = $song->getId();
        $track->songDetail = SongDetail::create($song->getTitle(), $song->getArtist());
        $track->price = $song->getPrice();

        return $track;
    }
}