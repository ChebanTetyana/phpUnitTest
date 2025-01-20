<?php

namespace Cheba\PhpUnit\WorldCup;

class ScoreBoard
{
    protected array $games = [];
    public function startGame(string $homeTeam, string $awayTeam): Game
    {
        $game = new Game($homeTeam, $awayTeam);
        $this->games[] = $game;
        return $game;
    }

    public function updateScore(Game $game, int $homeScore, int $awayScore): void
    {
        $game->setHomeScore($homeScore);
        $game->setAwayScore($awayScore);
    }

    public function finishGame(Game $game): void
    {
       $game->finishGame();
    }

    public function getSummary(): array
    {
        usort($this->games, function ($a, $b) {
            $totalScoreA = $a->getTotalScore();
            $totalScoreB = $b->getTotalScore();

            return $totalScoreA === $totalScoreB
                ? $b->addedAt - $a->getAddedAt
                : $totalScoreB - $totalScoreA;
        });

        $summary = [];
        foreach ($this->games as $game) {
            if (!$game->isFinished()) {
                $summary[] = $game->getHomeTeam() .
                    ' ' . $game->getHomeScore() .
                    ' - ' . $game->getAwayTeam() .
                    ' ' . $game->getAwayScore();
            }
        }
        return $summary;
    }
}
