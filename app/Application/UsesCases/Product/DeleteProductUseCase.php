<?php

namespace App\Application\UsesCases\Product;

use App\Domain\Repositories\ProductRepositoryInterface;

class DeleteProductUseCase
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}

    public function execute(int $id): void
    {
        $this->productRepository->delete($id);
    }
}
