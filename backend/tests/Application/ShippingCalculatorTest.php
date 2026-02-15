<?php

namespace App\Application;

use App\Application\Dto\ShippingRequest;
use App\Domain\Shipping\Carrier\CarrierRegistry;
use App\Domain\Shipping\Carrier\CarrirerInterface;
use PHPUnit\Framework\TestCase;

class ShippingCalculatorTest extends TestCase
{
    public function testHandleReturnsCorrectResponse(): void
    {
        $carrier = $this->createMock(CarrirerInterface::class);

        $carrier
            ->expects($this->once())
            ->method('calculate')
            ->willReturn(99.99);

        $registry = $this->createMock(CarrierRegistry::class);

        $registry
            ->expects($this->once())
            ->method('get')
            ->with('packgroup')
            ->willReturn($carrier);

        $calculator = new ShippingCalculator($registry);

        $request = new ShippingRequest();
        $request->carrier = 'packgroup';
        $request->weightKg = 5;

        $response = $calculator->handle($request);

        $this->assertEquals('packgroup', $response->carrier);
        $this->assertEquals(5, $response->weightKg);
        $this->assertEquals('EUR', $response->currency);
        $this->assertEquals(99.99, $response->price);
    }
}
