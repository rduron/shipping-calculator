<?php

namespace App\Domain\Shipping\Exception;

use RuntimeException;

class ValidationException extends RuntimeException
{
    public function __construct(public iterable $errors)
    {
        parent::__construct('Validation failed');
    }
}