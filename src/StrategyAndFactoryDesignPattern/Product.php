<?php

namespace Cheba\PhpUnit\StrategyAndFactoryDesignPattern;

class Product
{
    private string $name;
    private string $price;

    public function __construct(string $name, string $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function getPrice():float
    {
        return $this->price;
    }
}