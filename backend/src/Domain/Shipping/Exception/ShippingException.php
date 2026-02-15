<?php

namespace App\Domain\Shipping\Exception;

use DomainException;
use Throwable;

class ShippingException extends DomainException
{
    public function __construct(string $message = "Unsupported carrier", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}