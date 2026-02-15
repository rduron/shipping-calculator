<?php

namespace App\Application\Dto;

class ShippingResponse
{
    public function __construct(
        public string $carrier,
        public float $weightKg,
        public string $currency,
        public float $price
    ) {
    }
}