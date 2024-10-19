<?php

namespace Cheba\PhpUnit\Patterns;

use Exception;

class TransportFactory
{
    /**
     * @throws Exception
     */
    public function createTransport(string $type): Transport
    {
        if ($type === 'car') {
            return new Car();
        } elseif ($type === 'bike') {
            return new Bike();
        } else {
            throw new Exception('Unknown type of transport');
        }
    }
}
