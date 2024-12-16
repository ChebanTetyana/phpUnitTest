<?php

namespace Cheba\PhpUnit\Tests\StrategyAndFactoryDesignPattern;

use Cheba\PhpUnit\StrategyAndFactoryDesignPattern\Product;
use Cheba\PhpUnit\StrategyAndFactoryDesignPattern\ShoppingCartItem;
use Cheba\PhpUnit\StrategyAndFactoryDesignPattern\Strategy\StandardDiscount;
use Cheba\PhpUnit\StrategyAndFactoryDesignPattern\Strategy\WholesaleDiscount;
use PHPUnit\Framework\TestCase;

class DiscountStrategyTest extends TestCase
{
    public function testStandardStrategyAppliesNoDiscount()
    {
        $strategy = new StandardDiscount();
        $items = [
            new ShoppingCartItem(new Product('Bread', 100), 1),
            new ShoppingCartItem(new Product('Milk', 50), 2),
        ];

        $total = array_reduce($items, fn($carry, $item) => $carry + $item->getTotalPrice(), 0);
        $discountedTotal = $strategy->applyDiscount($items, $total);

        $this->assertEquals(
            200,
            $discountedTotal,
            "Standard discount should not reduce the total price.");
    }

    public function testWholeSaleStrategyApplies10PercentDiscount()
    {
        $strategy = new  WholesaleDiscount();
        $items = [
            new ShoppingCartItem(new Product('Bread', 100), 2),
            new ShoppingCartItem(new Product('Milk', 50), 4),
        ];

        $total = array_reduce($items, fn($carry, $item) => $carry + $item->getTotalPrice(), 0);
        $discountedTotal = $strategy->applyDiscount($items, $total);

        $this->assertEquals(
            360,
            $discountedTotal,
            "Wholesale discount should apply a 10% discount for less than 15 items.");
    }

    public function testWholeSaleStrategyApplies20PercentDiscount()
    {
        $strategy = new  WholesaleDiscount();
        $items = [
            new ShoppingCartItem(new Product('Bread', 100), 10),
            new ShoppingCartItem(new Product('Milk', 50), 10),
        ];

        $total = array_reduce($items, fn($carry, $item) => $carry + $item->getTotalPrice(), 0);
        $discountedTotal = $strategy->applyDiscount($items, $total);

        $this->assertEquals(
            1200,
            $discountedTotal,
            "Wholesale discount should apply a 20% discount for more than 15 items.'");
    }
}
