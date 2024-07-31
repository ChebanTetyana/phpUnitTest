<?php

namespace Cheba\PhpUnit\Models;

use Cheba\PhpUnit\Interfaces\Shape;

class Circle implements Shape
{
    private $radius;

    public function __construct(float $radius)
    {
        $this->radius = $radius;
    }

    public function getArea(): float
    {
        return pi() * pow($this->radius, 2);
    }

    public function getPerimeter(): float
    {
        return 2 * pi() * $this->radius;
    }
}
