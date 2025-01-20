<?php

namespace Cheba\PhpUnit\WorldCup;

use InvalidArgumentException;

class Game
{
    private  string $homeTeam;
    private  string $awayTeam;
    private int $homeScore = 0;
    private int $awayScore = 0;
    private bool $isFinished = false;
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

    public function setHomeTeam(string $homeTeam): void
    {
        if ($homeTeam === '' || $homeTeam === '-11' || strlen($homeTeam) > 255) {
            throw new InvalidArgumentException('Home team name cannot be empty, invalid, or exceed maximum length.');
        }
        $this->homeTeam = $homeTeam;
    }

    public function setAwayTeam(string $awayTeam): void
    {
        if ($awayTeam === '' || $awayTeam === '-11' || strlen($awayTeam) > 255) {
            throw new InvalidArgumentException('Away team name cannot be empty, invalid, or exceed maximum length.');
        }
        $this->awayTeam = $awayTeam;
    }

    public function setHomeScore(int $homeScore): void
    {
        if ($this->isFinished) {
            throw new InvalidArgumentException('Home team name cannot be empty, invalid, or exceed maximum length.');
        }

        if ($homeScore < 0) {
            throw new InvalidArgumentException('Score cannot be negative.');
        }
        $this->homeScore = $homeScore;
    }

    public function setAwayScore(int $awayScore): void
    {
        if ($this->isFinished) {
            throw new InvalidArgumentException('Cannot update score for a finished game.');
        }

        if ($awayScore < 0) {
            throw new InvalidArgumentException('Score cannot be negative.');
        }

        $this->awayScore = $awayScore;
    }

    public function equals(Game $game):bool
    {
        return $this->homeTeam === $game->homeTeam
            && $this->awayTeam === $game->awayTeam
            && $this->addedAt === $game->addedAt;
    }

    public function finishGame(): void
    {
        $this->isFinished = true;
    }

    public function isFinished(): bool
    {
        return $this->isFinished;
    }
}
