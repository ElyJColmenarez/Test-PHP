<?php

namespace App\Http\Controllers;


use App\Application\DTOs\ProductDTO;
use App\Http\Requests\StoreProductPriceRequest;
use App\Models\ProductPrice;
use App\Application\UsesCases\Product\{
    CreateProductUseCase,
    GetProductUseCase,
    UpdateProductUseCase,
    DeleteProductUseCase,
    GetProductPricesUseCase,
    CreateProductPriceUseCase
};
use App\Domain\Entities\ProductEntity;
use App\Domain\Entities\ProductPriceEntity;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(
        private CreateProductUseCase $createProductUseCase,
        private GetProductUseCase $getProductUseCase,
        private UpdateProductUseCase $updateProductUseCase,
        private DeleteProductUseCase $deleteProductUseCase,
        private GetProductPricesUseCase $getProductPricesUseCase,
        private CreateProductPriceUseCase $createProductPriceUseCase
    ){}
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $products = $this->getProductUseCase->execute();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request): JsonResponse
    {
        $product = new ProductEntity(
            $request->name,
            $request->description,
            $request->price,
            $request->currency_id,
            $request->tax_cost,
            $request->manufacturing_cost
        );

        $this->createProductUseCase->execute($product);
        return response()->json("Producto creado con exito.", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $product = $this->getProductUseCase->findById($id);
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, int $id) : JsonResponse
    {
        $product = new ProductEntity(
            $request->name,
            $request->description,
            $request->price,
            $request->currency_id,
            $request->tax_cost,
            $request->manufacturing_cost
        );

        $this->updateProductUseCase->execute($product, $id);
        return response()->json("Producto actualizado con exito.", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : JsonResponse
    {
        $this->deleteProductUseCase->execute($id);
        return response()->json(['message' => 'Producto eliminado'], 204);
    }

    public function prices(int $id): JsonResponse
    {
        $prices = $this->getProductPricesUseCase->execute($id);
        return response()->json($prices);
    }

    public function storePrice(StoreProductPriceRequest $request, int $id): JsonResponse
    {
        $productPrice = $this->createProductPriceUseCase->validateProductPrice(
            $request->currency_id,
            $id
        );

        if ($productPrice) {
            return response()->json(['message' => 'Ya existe un precio para este producto y moneda'], 422);
        }

        $price = new ProductPriceEntity(
            $id,
            $request->currency_id,
            $request->price
        );

        $this->createProductPriceUseCase->execute($price);
        return response()->json("Precio creado con exito", 201);
    }
}
