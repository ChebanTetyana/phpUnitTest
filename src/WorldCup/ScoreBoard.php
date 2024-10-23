<?php

namespace Cheba\PhpUnit\WorldCup;

class ScoreBoard
{
    protected array $games = [];
    public function startGame($homeTeam, $awayTeam): object
    {
        $game = new Game($homeTeam, $awayTeam);
        $this->games[] = $game;
        return $game;
    }

    public function updateScore($game, $homeScore, $awayScore): void
    {
        $game->homeScore = $homeScore;
        $game->awayScore = $awayScore;
    }

    public function finishGame($game): void
    {
        $this->games = array_filter($this->games, fn($g) => $g !== $game);
    }

    public function getSummary(): array
    {
        usort($this->games, function ($a, $b) {
            $totalScoreA = $a->getTotalScore();
            $totalScoreB = $b->getTotalScore();

            return $totalScoreA === $totalScoreB
                ? $b->addedAt - $a->addedAt
                : $totalScoreB - $totalScoreA;
        });

        $summary = [];
        foreach ($this->games as $game) {
            $summary[] = "$game->homeTeam $game->homeScore - $game->awayTeam $game->awayScore";
        }
        return $summary;
    }
}
