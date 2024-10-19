<?php

namespace Cheba\PhpUnit\Patterns;

class Car implements Transport
{
    public function drive()
    {
        return "Drive by car";
    }
}