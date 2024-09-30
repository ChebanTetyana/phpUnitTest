<?php

namespace Cheba\PhpUnit\Tests\WorldCup;

use Cheba\PhpUnit\WorldCup\ScoreBoard;
use PHPUnit\Framework\TestCase;

class ScoreBoardTest extends TestCase
{
    public function testStartGame()
    {
        $scoreBoard = new ScoreBoard();
        $game = $scoreBoard->startGame('Mexico', 'Canada');

        $this->assertEquals('Mexico', $game->homeTeam);
        $this->assertEquals('Canada', $game->awayTeam);
        $this->assertEquals(0, $game->homeScore);
        $this->assertEquals(0, $game->awayScore);

    }

    public function testUpdateScore()
    {
        $scoreBoard = new ScoreBoard();
        $game = $scoreBoard->startGame('Mexico', 'Canada');

        $scoreBoard->updateScore($game, 1, 2);

        $this->assertEquals(1, $game->homeScore);
        $this->assertEquals(2, $game->awayScore);
    }

    public function testFinishGame()
    {
        $scoreBoard = new ScoreBoard();
        $game = $scoreBoard->startGame('Mexico', 'Canada');

        $scoreBoard->updateScore($game, 1, 2);

        $scoreBoard->finishGame($game);

        $summary = $scoreBoard->getSummary();
        $this->assertNotContains($game, $summary);
    }
}
