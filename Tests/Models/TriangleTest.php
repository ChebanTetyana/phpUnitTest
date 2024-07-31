<?php

namespace Cheba\PhpUnit\Tests\Models;

use Cheba\PhpUnit\Models\Triangle;
use PHPUnit\Framework\TestCase;

class TriangleTest extends TestCase
{
    public function testArea()
    {
        $triangle = new Triangle(3, 4, 5);
        $this->assertEquals(6, $triangle->getArea());
    }

    public function testPerimeter()
    {
        $triangle = new Triangle(3, 4, 5);
        $this->assertEquals(12, $triangle->getPerimeter());
    }
}