<?php

namespace Cheba\PhpUnit\Services;

use Cheba\PhpUnit\Interfaces\Shape;

class ShapeCalculator
{
    public function calculate(Shape $shape): array
    {
        return [
            'area' => $shape->getArea(),
            'perimeter' => $shape->getPerimeter()
        ];
    }
}
