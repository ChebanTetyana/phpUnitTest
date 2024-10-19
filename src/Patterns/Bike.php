<?php

namespace Cheba\PhpUnit\Patterns;

class Bike implements Transport
{
    public function drive()
    {
        return "Drive by bike";
    }
}