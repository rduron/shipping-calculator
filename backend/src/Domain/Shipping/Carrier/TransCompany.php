<?php

namespace App\Domain\Shipping\Carrier;

use App\Domain\Shipping\ValueObject\Weight;

class TransCompany implements CarrirerInterface
{
    public const PRICE_LESS_10 = 20;
    public const PRICE_GREATER_10 = 100;
    private const CARRIER_SLUG = 'transcompany';

    public function calculate(Weight $weight): float
    {
        return $weight->value() <= 10 ? self::PRICE_LESS_10 : self::PRICE_GREATER_10;
    }

    public function slug(): string
    {
        return self::CARRIER_SLUG;
    }
}
