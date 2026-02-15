<?php

namespace App\Application;

use App\Application\Dto\ShippingRequest;
use App\Application\Dto\ShippingResponse;
use App\Domain\Shipping\Carrier\CarrierRegistry;
use App\Domain\Shipping\ValueObject\Weight;

class ShippingCalculator
{
    private const CURRENCY_CODE = 'EUR';

    public function __construct(private CarrierRegistry $carrierRegistry)
    {
    }

    public function handle(ShippingRequest $request): ShippingResponse
    {
        $weight = new Weight((float)$request->weightKg);
        $carrier = $this->carrierRegistry->get($request->carrier);
        $price = $carrier->calculate($weight);

        return new ShippingResponse(
            carrier: $request->carrier,
            weightKg: (float)$request->weightKg,
            currency: self::CURRENCY_CODE,
            price: $price
        );
    }
}