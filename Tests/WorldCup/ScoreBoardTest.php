<?php

namespace Cheba\PhpUnit\Tests\WorldCup;

use Cheba\PhpUnit\WorldCup\ScoreBoard;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ScoreBoardTest extends TestCase
{
    public function testStartGame(): void
    {
        $scoreBoard = new ScoreBoard();
        $game = $scoreBoard->startGame('Mexico', 'Canada');

        $this->assertEquals('Mexico', $game->getHomeTeam());
        $this->assertEquals('Canada', $game->getAwayTeam());
        $this->assertEquals(0, $game->getHomeScore());
        $this->assertEquals(0, $game->getAwayScore());

    }

    public function testUpdateScore(): void
    {
        $scoreBoard = new ScoreBoard();
        $game = $scoreBoard->startGame('Mexico', 'Canada');

        $scoreBoard->updateScore($game, 1, 2);

        $this->assertEquals(1, $game->getHomeScore());
        $this->assertEquals(2, $game->getAwayScore());
    }

    public function testFinishGame(): void
    {
        $scoreBoard = new ScoreBoard();
        $game = $scoreBoard->startGame('Mexico', 'Canada');

        $scoreBoard->updateScore($game, 1, 2);
        $scoreBoard->finishGame($game);

        $summary = $scoreBoard->getSummary();
        $this->assertNotContains("Mexico 1 - Canada 2", $summary);

        $this->assertTrue($game->isFinished(), 'The game must be marked as completed');
    }

    public function testSetNegativeScore(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $scoreBoard = new ScoreBoard();
        $game = $scoreBoard->startGame('Mexico', 'Canada');
        $scoreBoard->updateScore($game, -1, -2);
    }

    public function testSetVeryLongTeamName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Home team name cannot be empty, invalid, or exceed maximum length.');

        $scoreBoard = new ScoreBoard();
        $longTeamName = str_repeat('A', 256);
        $scoreBoard->startGame($longTeamName, 'Canada');
    }

    public function testSetEmptyTeamName(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $scoreBoard = new ScoreBoard();
        $scoreBoard->startGame('', 'Canada');
    }

    public function testSetInvalidTeamName(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $scoreBoard = new ScoreBoard();
        $scoreBoard->startGame('-11', 'Canada');
    }
}
