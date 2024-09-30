<?php

namespace Cheba\PhpUnit\QueensProblem;

class ChessBoard
{
    private int $size;
    public array $queens = [];

    public function __construct($size = 8)
    {
        $this->size = $size;
    }

    public function generate(): array
    {
        $this->queens = [];
        $this->generateArray(1);
        return $this->queens;
    }

    public function isQueensPositionArrayValid(array $queens): bool
    {
        if (count($queens) != $this->size) {
            return false;
        }

        for ($i = 1; $i <= count($queens); $i++) {
            for ($j = 1; $j <= count($queens); $j++) {
                if ($i != $j) {
                    if (!$this->isPositionValid($i, $queens[$i - 1], $j, $queens[$j - 1])) {
                        return false;
                    }
                }
            }
        }
        return true;
    }

    public function isPositionValid(int $existingQueenCol, int $existingQueenRow, int $col, int $row): bool
    {
        return !($row == $existingQueenRow ||
            $col == $existingQueenCol ||
            abs($row - $existingQueenRow) == abs($col - $existingQueenCol));
    }

   private function generateArray(int $initialColumn): void
    {
        if (count($this->queens) == $this->size) {
            return;
        }

        for ($row = 1; $row <= $this->size; $row++) {
            if ($this->isQueenPositionValid($initialColumn, $row)) {
                $this->queens[$initialColumn - 1] = $row;
                $this->generateArray($initialColumn + 1);
                if (count($this->queens) == $this->size) {
                    return;
                }
                unset($this->queens[$initialColumn - 1]);
            }
        }
    }

    private function isQueenPositionValid(int $col, int $row): bool
    {
        foreach ($this->queens as $existingCol=>$existingRow) {
            if (!$this->isPositionValid($existingCol + 1, $existingRow, $col, $row)) {
                return false;
            }
        }
        return true;
    }
}