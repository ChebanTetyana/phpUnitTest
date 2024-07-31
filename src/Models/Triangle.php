<?php

namespace Cheba\PhpUnit\Models;

use Cheba\PhpUnit\Interfaces\Shape;

class Triangle implements Shape
{
    private $a;
    private $b;
    private $c;

    public function __construct(float $a, float $b, float $c)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    public function getArea(): float
    {
        $s = ($this->a + $this->b + $this->c) / 2;
        return sqrt($s * ($s - $this->a) * ($s - $this->b) * ($s - $this->c));
    }

    public function getPerimeter(): float
    {
        return $this->a + $this->b + $this->c;
    }
}
