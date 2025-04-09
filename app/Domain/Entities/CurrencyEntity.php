<?php

namespace App\Domain\Entities;

class CurrencyEntity
{
    public function __construct(
        public int $id,
        public string $name,
        public string $symbol,
        public float $exchangeRate
    ) {}
}
