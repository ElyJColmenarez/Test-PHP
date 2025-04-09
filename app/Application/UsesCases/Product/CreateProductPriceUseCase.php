<?php

namespace App\Application\UsesCases\Product;

use App\Domain\Entities\ProductPriceEntity;
use App\Domain\Repositories\ProductRepositoryInterface;

class CreateProductPriceUseCase
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}

    public function execute(ProductPriceEntity $priceEntity): void
    {
        $this->productRepository->createPrice($priceEntity);
    }

    public function validateProductPrice(int $currency_id, int $product_id): bool
    {
        return $this->productRepository->validateProductPrice($currency_id, $product_id);
    }
}
