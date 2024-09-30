<?php

namespace Cheba\PhpUnit\Tests\QueensProblem;

use Cheba\PhpUnit\QueensProblem\ChessBoard;
use PHPUnit\Framework\TestCase;

class ChessBordTest extends TestCase
{

    public function testGenerateRerunsValidSolution()
    {
        $board = new ChessBoard();
        $queens = $board->generate();

        $this->assertCount(8, $queens, "Need to be 8 queens");

        foreach ($queens as $queen) {
            $this->assertGreaterThanOrEqual(1, $queen);
            $this->assertLessThanOrEqual(8, $queen);
        }

        $this->assertTrue(
            $board->isQueensPositionArrayValid($queens),
            "A queen should not attack a friend"
        );
    }

    /**
     * @dataProvider queenPositionsProvider
     */
    public function testIsPositionValid($col1, $row, $col2, $row2, $expected )
    {
        $board = new ChessBoard();
        $result = $board->isPositionValid($col1, $row, $col2, $row2);

        $this->assertEquals($expected, $result);
    }

    public function queenPositionsProvider(): array
    {
        return [
            [1, 1, 2, 2, false],
            [1, 1, 1, 3, false],
            [1, 1, 2, 1, false],
            [1, 1, 3, 2, true],
            [4, 4, 1, 1, false],
        ];
    }

    public function testIsQueenPositionArrayValid()
    {
        $board = new ChessBoard();

        $board->queens = [1, 5, 8, 6, 3, 7, 2, 4,];
        $this->assertTrue($board->isQueensPositionArrayValid($board->queens), "Queens are placed correctly");

        $board->queens = [1, 1, 8, 6, 3, 7, 2, 4,];
        $this->assertFalse($board->isQueensPositionArrayValid($board->queens), "Queens aren't placed correctly");
    }
}
