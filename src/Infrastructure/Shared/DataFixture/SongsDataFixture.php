<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\DataFixture;

use App\Domain\Item\Entity\Song;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SongsDataFixture extends Fixture
{
    private const STOCK = [
        ['Painkiller', 'Judas Priest', '3.99'],
        ['In Bloom', 'Nirvana', '3.99'],
        ['September', 'Earth, Wind and Fire', '4.99'],
        ['Is yeelyel', 'The Souljazz Orchestra', '2.99'],
        ['Paradise Circus', 'Massive Attack', '3.99'],
        ['I Want Freedom', 'Chris Joss', '2.99'],
        ['I Need a Dollar', 'Aloe Blacc', '2.99'],
        ['I Know You Got Soul', 'Bobby Byrd', '3.99'],
        ['Song 2', 'Blur', '2.99'],
        ['Egyptian Reggae', 'Jonathan Richard and The Modern Lovers', '1.99'],
        ['Green Onions', 'Booker T and M.Gs', '4.99'],
        ['Hurt', 'Johnny Cash', '4.99'],
        ['Fisherman', 'The Congos', '4.99'],
        ['What\'d I Say  Part 1 and 2', 'Ray Charles', '4.99'],
        ['You Really Got Me', 'Van Halen', '1.99'],
        ['Space Lizards', 'Me and You', '0.99'],
        ['Bitter Sweet Symphony', 'The Verve', '2.99'],
        ['Kick, Push', 'Lupe Fiasco', '4.99'],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::STOCK as $value) {
            $song = (new Song())
                ->setTitle($value[0])
                ->setArtist($value[1])
                ->setPrice($value[2]);

            $manager->persist($song);
        }
        $manager->flush();
    }
}