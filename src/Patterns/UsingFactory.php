<?php

require '../../vendor/autoload.php';

use Cheba\PhpUnit\Patterns\Bike;
use Cheba\PhpUnit\Patterns\Car;
use Cheba\PhpUnit\Patterns\TransportFactory;

$factory = new TransportFactory();
try {
    $transport = $factory->createTransport('chicken');
    echo $transport->drive();
} catch (Exception $e) {
    echo $e->getMessage();
    $transport = new Car();
}

echo "\n";

try {
    $transport = $factory->createTransport('bike');
    echo $transport->drive();
} catch (Exception $e) {
    echo $e->getMessage();
    $transport = new Bike();
}
