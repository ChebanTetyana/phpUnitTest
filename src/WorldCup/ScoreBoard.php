<?php

namespace Cheba\PhpUnit\WorldCup;

class ScoreBoard
{
    protected array $games = [];
    public function startGame($homeTeam, $awayTeam): object
    {
        return new Game($homeTeam, $awayTeam);
    }

    public function updateScore($game, $homeScore, $awayScore): void
    {
        $game->homeScore = $homeScore;
        $game->awayScore = $awayScore;
    }

    public function finishGame($game): void
    {
        $this->games = array_filter($this->games, function ($g) use ($game) {
            return $g != $game;
        });
    }

    public function getSummary(): array
    {
        return $this->games;
    }
}
