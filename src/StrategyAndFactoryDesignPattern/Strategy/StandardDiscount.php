<?php

namespace Cheba\PhpUnit\StrategyAndFactoryDesignPattern\Strategy;

class StandardDiscount implements DiscountStrategy
{
    public function applyDiscount(array $items, float $total): float
    {
        if (empty($items)) {
            return 0;
        }

        return $total;
    }
}
