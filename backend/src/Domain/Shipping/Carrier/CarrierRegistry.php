<?php

namespace App\Domain\Shipping\Carrier;

use App\Domain\Shipping\Exception\ShippingException;

class CarrierRegistry
{
    private array $carriers;

    /**
     * @param $carriers CarrirerInterface[]
     */
    public function __construct(iterable $carriers)
    {
        /** @var CarrirerInterface $carrier */
        foreach ($carriers as $carrier) {
            $this->carriers[$carrier->slug()] = $carrier;
        }
    }

    public function get(string $name): CarrirerInterface
    {
        if (!isset($this->carriers[$name])) {
            throw new ShippingException();
        }

        return $this->carriers[$name];
    }
}
