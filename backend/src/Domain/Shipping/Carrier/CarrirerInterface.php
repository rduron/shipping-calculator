<?php

namespace App\Domain\Shipping\Carrier;

use App\Domain\Shipping\ValueObject\Weight;

interface CarrirerInterface
{
    public function calculate(Weight $weight): float;

    public function slug(): string;
}