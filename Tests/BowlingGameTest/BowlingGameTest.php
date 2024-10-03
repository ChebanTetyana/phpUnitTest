<?php

namespace Cheba\PhpUnit\Tests\BowlingGameTest;

use Cheba\PhpUnit\BowlingGame\BowlingGame;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class BowlingGameTest extends TestCase
{
    private BowlingGame $game;

    protected function setUp(): void
    {
        $this->game = new BowlingGame();
    }

    public function testStartOfGame()
    {
        $scores = $this->game->getResult();
        $this->assertEmpty($scores);
    }

    public function testWhenRollZeroThenMoveToNextRoll(): void
    {
        $pinHits = $this->game->roll(0);
        $this->assertEquals(0, $pinHits);
    }

    public function testWhenRollLessThanZeroThenThrowException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid number of pins.');
        $this->game->roll(-1);
    }

    public function testWhenRollMoreThanTenPinsThenThrowException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid number of pins.');
        $this->game->roll(11);
    }

    public function testCalculateScoreForSingleStrike(): void
    {
        $this->game->roll(10);
        $this->game->roll(3);
        $this->game->roll(6);

        $scores = $this->game->getResult();
        $this->assertEquals(19, $scores[0]);
        $this->assertEquals(28, $scores[1]);
    }

    public function testCalculateScoreForSingleSpare(): void
    {
        $this->game->roll(7);
        $this->game->roll(3);
        $this->game->roll(4);

        $scores = $this->game->getResult();
        $this->assertEquals(10, $scores[0]);
        $this->assertEquals(14, $scores[1]);
    }

    public function testRollStrike()
    {
        $pinsHit = $this->game->roll(10);
        $this->assertEquals(10, $pinsHit);
    }

    public function testRollSpare()
    {
        $this->game->roll(7);
        $secondRoll = $this->game->roll(3);

        $this->assertEquals(3, $secondRoll);
        $this->assertEquals(10, $this->game->getResult()[0]);
    }

    public function testRoll()
    {
        $this->game->roll(3);
        $this->game->roll(6);
        $this->assertEquals([0 => 9], $this->game->getResult());
    }

    public function testGameOver()
    {
        for ($i = 0; $i < 20; $i++) {
            $this->game->roll(1);
        }
        $this->assertEquals("Game over!", $this->game->roll(1));
    }

    public function testFinalScore()
    {
        for ($i = 0; $i < 12; $i++) {
            $this->game->roll(10);
        }
        $scores = $this->game->getResult();
        $this->assertEquals(300, end($scores));
    }

    public function testIncompleteGameScore(): void
    {
        $this->game->roll(5);
        $this->game->roll(4);

        $scores = $this->game->getResult();
        $this->assertEquals([9], $scores);
    }

    public function testThreeFinalThrowsAfterStrike(): void
    {
        for ($i = 0; $i < 18; $i++) {
            $this->game->roll(0);
        }

        $this->game->roll(10);
        $this->game->roll(10);
        $this->game->roll(10);

        $scores = $this->game->getResult();
        $this->assertEquals(30, end($scores));
    }

    public function testThreeFinalThrowsAfterSpare(): void
    {
        for ($i = 0; $i < 18; $i++) {
            $this->game->roll(0);
        }

        $this->game->roll(5);
        $this->game->roll(5);
        $this->game->roll(10);

        $scores = $this->game->getResult();
        $this->assertEquals(10, end($scores));
    }

    /**
     * @dataProvider fullGameDataProvider
     */

    public function testFullGame(array $rolls, $expectedScore)
    {
        foreach ($rolls as $pins) {
            $this->game->roll($pins);
        }

        $scores = $this->game->getResult();
        $this->assertEquals($expectedScore, end($scores));
    }

    public function fullGameDataProvider(): array
    {
        return [
            'perfect game' => [
                'rolls' => array_fill(0, 12, 10),
                'expectedScore' => 300,
            ],
            'all spares' => [
                'rolls' => array_merge(array_fill(0, 21, 5)),
                'expectedCode' => 100,
            ],
            'random game' => [
                'rolls' => [10, 9, 1, 5, 5, 7, 2, 10, 10, 10, 9, 0, 8, 2, 9, 1, 10],
                'expectedCode' => 156,
            ],
            'worst game' => [
                'rolls' => array_fill(0, 20, 0),
                'expectedCode' => 0,
            ],
        ];
    }
}
