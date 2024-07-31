<?php

namespace Cheba\PhpUnit\Tests;

use Cheba\PhpUnit\Calculator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testAdd()
    {
        $calculator = new Calculator();

        $result = $calculator->add(2, 3);
        $this->assertEquals(5, $result);

        $result = $calculator->add(-2, 3);
        $this->assertEquals(1, $result);

        $result = $calculator->add(-2, -3);
        $this->assertEquals(-5, $result);

        $result = $calculator->add(0, 0);
        $this->assertEquals(0, $result);
    }

    public function testMultiplication()
    {
        $calculator = new Calculator();

        $result = $calculator->multiplication(2, 3);
        $this->assertEquals(6, $result);

        $result = $calculator->multiplication(0, 3);
        $this->assertEquals(0, $result);

        $result = $calculator->multiplication(-2, 3);
        $this->assertEquals(-6, $result);

        $result = $calculator->multiplication(-2, -3);
        $this->assertEquals(6, $result);
    }

    public function testDivision()
    {
        $calculator = new Calculator();

        $result = $calculator->division(9, 3);
        $this->assertEquals(3, $result);

        $result = $calculator->division(9, -3);
        $this->assertEquals(-3, $result);

        $result = $calculator->division(-9, -3);
        $this->assertEquals(3, $result);
    }


    public function testDivisionByZero()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Division by xero');

        $calculator = new Calculator();
        $result = $calculator->division(9, 0);
    }
}
