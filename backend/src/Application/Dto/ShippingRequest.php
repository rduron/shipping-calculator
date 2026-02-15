<?php

namespace App\Application\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class ShippingRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public ?string $carrier = null;

    #[Assert\NotBlank]
    #[Assert\Type('numeric')]
    #[Assert\GreaterThan(0)]
    public mixed $weightKg = null;
}
