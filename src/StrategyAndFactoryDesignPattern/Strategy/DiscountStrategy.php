<?php

namespace Cheba\PhpUnit\StrategyAndFactoryDesignPattern\Strategy;

interface DiscountStrategy
{
    public function applyDiscount(array $items, float $total): float;
}
