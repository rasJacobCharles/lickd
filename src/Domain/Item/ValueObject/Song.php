<?php

declare(strict_types=1);

namespace App\Domain\Item\ValueObject;

use Assert\Assertion;
use Assert\AssertionFailedException;

class Song
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $artist;

    private function __construct(string $title, string $artist)
    {
        $this->title = $title;
        $this->artist = $artist;
    }

    /**
     * @throws AssertionFailedException
     */
    public static function create(string $title, string $artist): Song
    {
        Assertion::notEmpty($title);
        Assertion::notEmpty($artist);

        return new self($title, $artist);
    }
}