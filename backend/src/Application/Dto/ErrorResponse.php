<?php

namespace App\Application\Dto;

class ErrorResponse
{
    public function __construct(public string $error)
    {
    }
}