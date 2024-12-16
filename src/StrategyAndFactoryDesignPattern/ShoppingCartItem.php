<?php

namespace Cheba\PhpUnit\StrategyAndFactoryDesignPattern;

class ShoppingCartItem
{
    private Product $product;
    private int $quantity;

    public function __construct(Product $product, $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getTotalPrice(): float
    {
        return $this->product->getPrice() * $this->quantity;
    }
}