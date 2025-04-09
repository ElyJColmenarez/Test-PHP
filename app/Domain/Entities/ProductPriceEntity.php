<?php

namespace App\Domain\Entities;

class ProductPriceEntity
{
    public function __construct(
        public int $productId,
        public int $currencyId,
        public float $price
    ) {}
}
