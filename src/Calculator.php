<?php

namespace Cheba\PhpUnit;

class Calculator
{
    public function add($a, $b)
    {
        return $a + $b;
    }

    public function multiplication($a, $b)
    {
        return $a * $b;
    }

    public function isPrime($number)
    {
        if($number<=1) {
            return false;
        }

        if($number<=3) {
            return true;
        }

        if($number % 2==0|| $number % 3 == 0) {
            return false;
        }

        for ($i = 5; $i * $i <= $number; $i += 6) {
            if ($number % $i == 0 || $number % ($i + 2) == 0) {
                return false;
            }
        }

        return true;
    }

    public function gcd($a, $b)
    {
        while ($b != 0) {
            $t = $b;
            $b = $a % $b;
            $a = $t;
        }
        return $a;
    }

    public function coprime($a, $b)
    {
        return $this->gcd($a, $b) == 1;
    }
}
