<?php

namespace Cheba\PhpUnit\Tests\Models;

use Cheba\PhpUnit\Models\Rectangle;
use PHPUnit\Framework\TestCase;

class CircleTest extends TestCase
{
    public function testArea()
    {
        $rectangle = new Rectangle(4, 5);
        $this->assertEquals(20, $rectangle->getArea());
    }

    public function testPerimeter()
    {
        $rectangle = new Rectangle(4, 5);
        $this->assertEquals(18, $rectangle->getPerimeter());
    }
}