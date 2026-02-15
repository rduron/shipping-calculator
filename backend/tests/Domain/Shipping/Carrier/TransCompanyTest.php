<?php

namespace App\Domain\Shipping\Carrier;

use App\Domain\Shipping\ValueObject\Weight;
use PHPUnit\Framework\TestCase;

class TransCompanyTest extends TestCase
{
    public function testCalculate(): void
    {
        $carrier = new TransCompany();
        // check price for weight less or equals than 10 kg
        $this->assertEquals(TransCompany::PRICE_LESS_10, $carrier->calculate(new Weight(5.1)));
        $this->assertEquals(TransCompany::PRICE_LESS_10, $carrier->calculate(new Weight(10)));

        // check price for weight more than 10 kg
        $this->assertEquals(TransCompany::PRICE_GREATER_10, $carrier->calculate(new Weight(10.1)));
    }
}
