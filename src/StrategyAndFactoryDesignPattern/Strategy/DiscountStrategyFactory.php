<?php

namespace Cheba\PhpUnit\StrategyAndFactoryDesignPattern\Strategy;

use Cheba\PhpUnit\Enums\ClientType;

class DiscountStrategyFactory
{
    public static function create(ClientType $clientType): DiscountStrategy
    {
        return match ($clientType) {
            ClientType::Wholesale => new WholesaleDiscount(),
            ClientType::Standard => new StandardDiscount(),
        };
    }
}
