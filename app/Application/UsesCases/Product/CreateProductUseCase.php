<?php

namespace App\Application\UsesCases\Product;

use App\Domain\Entities\ProductEntity;
use App\Domain\Repositories\ProductRepositoryInterface;

class CreateProductUseCase
{


    public function __construct( private ProductRepositoryInterface $repository)
    {}

    public function execute(ProductEntity $productEntity): void
    {
        $this->repository->create($productEntity);
    }
}
