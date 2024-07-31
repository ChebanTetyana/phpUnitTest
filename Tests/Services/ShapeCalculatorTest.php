<?php

namespace Cheba\PhpUnit\Tests\Services;

use Cheba\PhpUnit\Models\Circle;
use Cheba\PhpUnit\Models\Rectangle;
use Cheba\PhpUnit\Models\Square;
use Cheba\PhpUnit\Models\Triangle;
use Cheba\PhpUnit\Services\ShapeCalculator;
use PHPUnit\Framework\TestCase;

class ShapeCalculatorTest extends TestCase
{
    public function testCalculateArea()
    {
        $calculator = new ShapeCalculator();

        $rectangle = new Rectangle(4, 5);
        $this->assertEquals(20, $calculator->calculate($rectangle));

        $circle = new Circle(3);
        $this->assertEqualsWithDelta(28.27, $calculator->calculate($circle), 0.01);

        $square = new Square(4);
        $this->assertEquals(16, $calculator->calculate($square));

        $triangle = new Triangle(3, 4, 5);
        $this->assertEquals(6, $calculator->calculate($triangle));
    }

    public function testCalculatePerimeter()
    {
        $calculator = new ShapeCalculator();

        $rectangle = new Rectangle(4, 5);
        $this->assertEquals(18, $calculator->calculate($rectangle));

        $circle = new Circle(3);
        $this->assertEqualsWithDelta(18.85, $calculator->calculate($circle), 0.01);

        $square = new Square(4);
        $this->assertEquals(16, $calculator->calculate($square));

        $triangle = new Triangle(3, 4, 5);
        $this->assertEquals(12, $calculator->calculate($triangle));
    }
}
