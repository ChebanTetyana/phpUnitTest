<?php

namespace Cheba\PhpUnit\BowlingGame;

use InvalidArgumentException;

class BowlingGame
{
    /** @var array<int[]> */
    private array $frames = [];

    /** @var int */
    private int $currentFrame = 1;

    /** @var bool */
    private bool $isFirstRoll = true;

    /** @var int */
    private int $bonusRolls = 0;

    public function __construct()
    {
    }

    public function roll(int $pinsHit): int|string
    {
        if ($this->isGameOver()) {
            return "Game over!";
        }

        $this->validatePins($pinsHit);

        if ($this->isBonusFrame() || $this->currentFrame <= 9) {
            $this->handleRoll($pinsHit);
        } else {
            $this->handleBonusRoll($pinsHit);
        }
        return $this->isGameOver() ? "Game over!" : $pinsHit;
    }

    public function getResult(): array
    {
        $scores = [];
        $totalScore = 0;

        foreach ($this->frames as $i => $frame) {
            $frameScore = $this->calculateFrameScore($frame, $i);

            $totalScore += $frameScore;
            $scores[] = $totalScore;

            if ($i == 9) {
                break;
            }
        }
        return $scores;
    }

    private function calculateFrameScore(array $frame, int $i): int
    {
        $frameScore = array_sum(array_filter($frame, fn($val) => is_numeric($val)));

        if ($this->isStrike($frame)) {
            $frameScore += $this->getStrikeBonus($i);
        } elseif ($this->isSpare($frame)) {
            $frameScore += $this->getSpareBonus($i);
        }

        return $frameScore;
    }

    private function isGameOver(): bool
    {
        return $this->currentFrame > 10;
    }

    private function validatePins(int $pinsHit): void
    {
        if ($pinsHit < 0 || $pinsHit > 10) {
            throw new InvalidArgumentException('Invalid number of pins.');
        }
    }

    private function isBonusFrame(): int
    {
        return $this->bonusRolls > 0;
    }

    private function processFirstRoll(int $pinsHit): void
    {
        if ($pinsHit == 10 && $this->currentFrame < 10) {
            $this->frames[] = [10];
            $this->currentFrame++;
        } else {
            $this->frames[] = [$pinsHit];
            $this->isFirstRoll = false;
        }
    }

    private function handleRoll(int $pinsHit): void
    {
        if ($this->isFirstRoll) {
            $this->processFirstRoll($pinsHit);
        } else {
            $this->processSecondRoll($pinsHit);
        }
    }

    private function processSecondRoll(int $pinsHit): void
    {
        $this->frames[count($this->frames) - 1][] = $pinsHit;
        if ($this->isSpare($this->frames[count($this->frames) - 1])) {
            $this->frames[count($this->frames) - 1][] = 'Spare';
        }
        $this->currentFrame++;
        $this->isFirstRoll = true;
    }

    private function handleBonusRoll(int $pinsHit): void
    {
        if ($this->isFirstRoll) {
            $this->frames[] = [$pinsHit];
            if ($pinsHit == 10) {
                $this->bonusRolls = 2;
            } else {
                $this->isFirstRoll = false;
                $this->bonusRolls = 1;
            }
        } else {
            $this->frames[count($this->frames) - 1][] = $pinsHit;
            $this->bonusRolls--;
            if ($this->bonusRolls === 0) {
                $this->currentFrame++;
            }
        }
    }

    private function getStrikeBonus($frameIndex): int
    {
        $bonus = 0;
        if (isset($this->frames[$frameIndex + 1])) {
            $nextFrame = $this->frames[$frameIndex + 1];
            $bonus += $nextFrame[0];
            if (isset($nextFrame[1])) {
                $bonus += $nextFrame[1];
            } elseif (isset($this->frames[$frameIndex + 2])) {
                $bonus += $this->frames[$frameIndex + 2][0];
            }
        }
        return $bonus;
    }

    private function getSpareBonus($frameIndex): int
    {
        return $this->frames[$frameIndex + 1][0] ?? 0;
    }

    private function isStrike(array $frame): int
    {
        return count($frame) == 1 && $frame[0] == 10;
    }

    private function isSpare(array $frame): int
    {
        return count($frame) == 2 && array_sum($frame) == 10;
    }
}
