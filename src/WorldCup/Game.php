<?php

namespace Cheba\PhpUnit\WorldCup;

use InvalidArgumentException;

class Game
{
    private  string $homeTeam;
    private  string $awayTeam;
    private int $homeScore = 0;
    private int $awayScore = 0;
    private int $addedAt;

    public function __construct(string $homeTeam, string $awayTeam)
    {
        $this->setHomeTeam($homeTeam);
        $this->setAwayTeam($awayTeam);
        $this->addedAt = time();
    }

    public function getHomeTeam(): string
    {
        return $this->homeTeam;
    }

    public function getAwayTeam(): string
    {
        return $this->awayTeam;
    }

    public function getHomeScore(): int
    {
        return $this->homeScore;
    }

    public function getAwayScore(): int
    {
        return $this->awayScore;
    }

    public function getAddedAt(): int
    {
        return $this->addedAt;
    }

    public function setHomeTeam(string $homeTeam): void
    {
        if ($homeTeam === '' || $homeTeam === '-11') {
            throw new InvalidArgumentException('Home team name cannot be empty or invalid.');
        }
        $this->homeTeam = $homeTeam;
    }

    public function setAwayTeam(string $awayTeam): void
    {
        if ($awayTeam === '' || $awayTeam === '-11') {
            throw new InvalidArgumentException('Away team name cannot be empty or invalid.');
        }
        $this->awayTeam = $awayTeam;
    }

    public function setHomeScore($homeScore): void
    {
        if ($homeScore < 0) {
            throw new InvalidArgumentException('Score cannot be negative.');
        }
        $this->homeScore = $homeScore;
    }

    public function setAwayScore($awayScore): void
    {
        if ($awayScore < 0) {
            throw new InvalidArgumentException('Score cannot be negative.');
        }

        $this->awayScore = $awayScore;
    }

    public function getTotalScore(): int
    {
        return $this->homeScore + $this->awayScore;
    }

    public function equals(Game $game):bool
    {
        return $this->homeTeam === $game->homeTeam
            && $this->awayTeam === $game->awayTeam
            && $this->addedAt === $game->addedAt;
    }
}
