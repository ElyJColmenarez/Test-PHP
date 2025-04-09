<?php

namespace App\Domain\Entities;

class ProductEntity
{
    public function __construct(
        public string $name,
        public string $description,
        public float $price,
        public int $currencyId,
        public float $taxCost,
        public float $manufacturingCost
    ) {}
}
