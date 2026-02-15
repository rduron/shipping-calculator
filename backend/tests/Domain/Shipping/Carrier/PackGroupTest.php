<?php

namespace App\Domain\Shipping\Carrier;

use App\Domain\Shipping\ValueObject\Weight;
use PHPUnit\Framework\TestCase;

class PackGroupTest extends TestCase
{
    public function testCalculate(): void
    {
        $packGroup = new PackGroup(2);

        $this->assertEquals(5, $packGroup->calculate(new Weight(2.5)));
    }
}
