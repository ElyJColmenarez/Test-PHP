<?php

namespace App\Application\DTOs;

use App\Domain\Entities\ProductEntity;

class ProductDTO
{
    public function __construct(
        public string $name,
        public string $description,
        public float $price,
        public int $currencyId,
        public float $taxCost,
        public float $manufacturingCost
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->name,
            $request->description,
            $request->price,
            $request->currency_id,
            $request->tax_cost,
            $request->manufacturing_cost
        );
    }

    public function toEntity(): ProductEntity
    {
        return new ProductEntity(
            $this->name,
            $this->description,
            $this->price,
            $this->currencyId,
            $this->taxCost,
            $this->manufacturingCost
        );
    }
}
