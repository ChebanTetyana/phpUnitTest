<?php

namespace Cheba\PhpUnit\tests;

use Cheba\PhpUnit\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testAdd()
    {
        $calculator = new Calculator();
        $result = $calculator->add(2, 3);
        $this->assertEquals(5, $result);
    }

    public function testMultiplication()
    {
        $calculator = new Calculator();
        $result = $calculator->multiplication(2, 3);
        $this->assertEquals(6, $result);
    }
}
