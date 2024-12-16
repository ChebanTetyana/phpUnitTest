<?php

namespace Cheba\PhpUnit\StrategyAndFactoryDesignPattern\Strategy;

class WholesaleDiscount implements DiscountStrategy
{
    public function applyDiscount(array $items, float $total): float
    {
        $totalQuantity = array_sum(array_map(fn($item) => $item->getQuantity(), $items));

        if (empty($items)) {
            return 0;
        }

        if ($totalQuantity > 15) {
            return $total * 0.8;
        } elseif ($totalQuantity > 0) {
            return $total * 0.9;
        }

        return $total;
    }
}
