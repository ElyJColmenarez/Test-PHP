<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\ProductEntity;
use App\Domain\Entities\ProductPriceEntity;
use App\Domain\Repositories\ProductRepositoryInterface;
use App\Models\Product;
use App\Models\ProductPrice;

class ProductRepository implements ProductRepositoryInterface
{
    public function create(ProductEntity $productEntity): void
    {
       $product =  Product::create([
            'name' => $productEntity->name,
            'description' => $productEntity->description,
            'price' => $productEntity->price,
            'currency_id' => $productEntity->currencyId,
            'tax_cost' => $productEntity->taxCost,
            'manufacturing_cost' => $productEntity->manufacturingCost
        ]);
    }

    public function getAll(): array
    {
        return Product::all()->toArray();
    }

    public function findById(int $id)
    {
        return Product::find($id);
    }

    public function update(ProductEntity $productEntity, int $id): void
    {
        $product = Product::find($id);
        $product->update([
            'name' => $productEntity->name,
            'description' => $productEntity->description,
            'price' => $productEntity->price,
            'currency_id' => $productEntity->currencyId,
            'tax_cost' => $productEntity->taxCost,
            'manufacturing_cost' => $productEntity->manufacturingCost
        ]);
    }

    public function delete(int $id): void
    {
        Product::destroy($id);
    }

    public function getPrices(int $productId)
    {
        return ProductPrice::where('product_id', $productId)->get();
    }

    public function createPrice(ProductPriceEntity $priceEntity): void
    {
        ProductPrice::create([
            'product_id' => $priceEntity->productId,
            'currency_id' => $priceEntity->currencyId,
            'price' => $priceEntity->price
        ]);
    }

    public function validateProductPrice(int $currency_id, int $product_id): bool
    {
        return ProductPrice::where('currency_id', $currency_id)
            ->where('product_id', $product_id)
            ->exists();
    }
}
