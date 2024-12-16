<?php

namespace Cheba\PhpUnit\StrategyAndFactoryDesignPattern;

use Cheba\PhpUnit\StrategyAndFactoryDesignPattern\Strategy\DiscountStrategy;

class ShoppingCart
{
    private Client $client;
    private array $items = [];
    private DiscountStrategy $discountStrategy;

    public function __construct(Client $client, DiscountStrategy $discountStrategy)
    {
        $this->client = $client;
        $this->discountStrategy = $discountStrategy;
    }

    public function addItem(Product $product, int $quantity = 1): void
    {
        $this->items[] = new ShoppingCartItem($product, $quantity);
    }

    public function getSummary(): float
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->getTotalPrice();
        }

        return $this->discountStrategy->applyDiscount($this->items, $total);
    }
}