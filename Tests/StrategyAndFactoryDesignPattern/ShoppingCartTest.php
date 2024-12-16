<?php

namespace Cheba\PhpUnit\Tests\StrategyAndFactoryDesignPattern;

use Cheba\PhpUnit\Enums\ClientType;
use Cheba\PhpUnit\StrategyAndFactoryDesignPattern\Client;
use Cheba\PhpUnit\StrategyAndFactoryDesignPattern\Product;
use Cheba\PhpUnit\StrategyAndFactoryDesignPattern\ShoppingCart;
use Cheba\PhpUnit\StrategyAndFactoryDesignPattern\Strategy\DiscountStrategyFactory;
use PHPUnit\Framework\TestCase;

class ShoppingCartTest extends TestCase
{
    public function testStandardClientNoDiscount()
    {
        $client = new Client('Standard Client', ClientType::Standard);
        $discountStrategy = DiscountStrategyFactory::create($client->getType());
        $cart = new ShoppingCart($client, $discountStrategy);

        $cart->addItem(new Product('Bread', 10), 2);
        $cart->addItem(new Product('Milk', 20), 2);

        $this->assertEquals(
            60,
            $cart->getSummary(),
            'Standard client should pay the full price.');
    }

    public function testWholesaleClient10PercentDiscount()
    {
        $client = new Client('Wholesale Client', ClientType::Wholesale);
        $discountStrategy = DiscountStrategyFactory::create($client->getType());
        $cart = new ShoppingCart($client, $discountStrategy);

        $cart->addItem(new Product('Bread', 10), 3);
        $cart->addItem(new Product('Milk', 20), 3);

        $this->assertEquals(
            81,
            $cart->getSummary(),
            'Wholesale client should receive a 10% discount for 6 items.');
    }

    public function testWholesaleClient20PercentDiscount()
    {
        $client = new Client('Wholesale Client', ClientType::Wholesale);
        $discountStrategy = DiscountStrategyFactory::create($client->getType());
        $cart = new ShoppingCart($client, $discountStrategy);

        $cart->addItem(new Product('Bread', 1000), 10);
        $cart->addItem(new Product('Milk', 500), 10);

        $this->assertEquals(
            12000,
            $cart->getSummary(),
            'Wholesale client should receive a 20% discount for more than 15 items.');
    }

    public function testEmptyCart()
    {
        $client = new Client('Standard Client', ClientType::Standard);
        $discountStrategy = DiscountStrategyFactory::create($client->getType());
        $cart = new ShoppingCart($client, $discountStrategy);

        $this->assertEquals(
            0,
            $cart->getSummary(),
            'An empty cart should have a total of 0.');
    }
}
