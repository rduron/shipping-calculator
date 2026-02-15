<?php

namespace App\Domain\Shipping\ValueObject;

use InvalidArgumentException;

final class Weight
{
    private float $value;

    public function __construct(float $value)
    {
        if ($value <= 0) {
            throw new InvalidArgumentException('Value must be greater than zero.');
        }
        $this->value = $value;
    }

    public function value(): float
    {
        return $this->value;
    }
}
