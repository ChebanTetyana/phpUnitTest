<?php

namespace Cheba\PhpUnit\Tests;

use Cheba\PhpUnit\FizzBuzz;
use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase
{
    /**
     * @dataProvider  fizzBuzzProvider
     */
    public function testGenerate($start, $end, $expected)
    {
        $fizzBuzz = new FizzBuzz();
        $result = $fizzBuzz->generate($start, $end);

        $this->assertEquals($expected, $result);
    }

    public function fizzBuzzProvider()
    {
        return [
            [1, 5, ['1', '2', 'Fizz', '4', 'Buzz']],
            [1, 3, ['1', '2', 'Fizz']],
            [10, 15, ['Buzz', '11', 'Fizz', '13', '14', 'FizzBuzz']],
        ];
    }
}