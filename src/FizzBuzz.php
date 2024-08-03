<?php

namespace Cheba\PhpUnit;

class FizzBuzz
{

    public function generate(int $start, int $end): array
    {
        $result = [];
        for ($i = $start; $i<=$end; $i++) {
            if ($i % 3 === 0 && $i % 5 === 0) {
                $result[] = 'FizzBuzz';
            } elseif ($i % 3 === 0) {
                $result[] = 'Fizz';
            } elseif ($i % 5 === 0) {
                $result[] = 'Buzz';
            } else {
                $result[] = (string)$i;
            }
        }
        return $result;
    }
}