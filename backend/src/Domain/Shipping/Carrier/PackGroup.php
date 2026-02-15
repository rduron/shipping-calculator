<?php

namespace App\Domain\Shipping\Carrier;

use App\Domain\Shipping\ValueObject\Weight;

class PackGroup implements CarrirerInterface
{
    public function __construct(private int $pricePerKg = 1)
    {
    }

    private const CARRIER_SLUG = 'packgroup';

    public function calculate(Weight $weight): float
    {
        return $weight->value() * $this->pricePerKg;
    }

    public function slug(): string
    {
        return self::CARRIER_SLUG;
    }
}