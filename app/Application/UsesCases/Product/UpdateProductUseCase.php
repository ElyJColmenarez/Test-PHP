<?php

namespace App\Application\UsesCases\Product;

use App\Domain\Entities\ProductEntity;
use App\Domain\Repositories\ProductRepositoryInterface;

class UpdateProductUseCase
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}

    public function execute(ProductEntity $productEntity, int $id): void
    {
        $this->productRepository->update($productEntity, $id);
    }


}
