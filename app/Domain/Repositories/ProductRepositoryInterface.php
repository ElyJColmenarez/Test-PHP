<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\ProductEntity;
use App\Domain\Entities\ProductPriceEntity;

interface ProductRepositoryInterface
{
    public function create(ProductEntity $productEntity): void;
    public function getAll(): array;
    public function findById(int $id);
    public function update(ProductEntity $productEntity, int $id): void;
    public function delete(int $id): void;
    public function getPrices(int $productId);
    public function createPrice(ProductPriceEntity $priceEntity): void;
    public function validateProductPrice(int $currency_id, int $product_id): bool;
}
