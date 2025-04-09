<?php

namespace App\Application\UsesCases\Product;

use App\Domain\Repositories\ProductRepositoryInterface;

class GetProductUseCase
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}

    public function execute(): array
    {
        return $this->productRepository->getAll();
    }

    public function findById(string $id)
    {
        return $this->productRepository->findById($id);
    }
}
