<?php

namespace App\Application\UsesCases\Product;

use App\Domain\Repositories\ProductRepositoryInterface;

class GetProductPricesUseCase
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}

    public function execute(int $productId)
    {
        return $this->productRepository->getPrices($productId);
    }
}
