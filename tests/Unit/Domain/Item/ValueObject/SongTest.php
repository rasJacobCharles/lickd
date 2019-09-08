<?php

declare(strict_types=1);


namespace Tests\Unit\Domain\Item\ValueObject;

use App\Domain\Item\ValueObject\Song;
use Assert\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class SongTest extends TestCase
{

    public function testSuccessCreateSong(): void
    {
        $this->assertInstanceOf(
            Song::class,
            $result = Song::create('The Imperial March', 'John Williams')
        );
        $this->assertEquals('The Imperial March', $result->title);
        $this->assertEquals('John Williams', $result->artist);
    }

    /**
     * @dataProvider invalidSongDataProvider
     */
    public function testFailureInvalidArgument(string $title, string $artist): void
    {
        $this->expectException(AssertionFailedException::class);
        Song::create($title, $artist);
    }
    public function invalidSongDataProvider(): array
    {
        return [
            ['The Imperial March', ''],
            ['', 'John Williams']
        ];
    }
}
