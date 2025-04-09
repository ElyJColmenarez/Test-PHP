<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Rutas públicas (sin autenticación)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas (requieren JWT)
Route::middleware('jwt.auth')->group(function () {
    Route::apiResource('products', ProductController::class)->except(['edit', 'create']);
    Route::post('products/{id}/prices', [ProductController::class, 'storePrice']);
    Route::get('products/{id}/prices', [ProductController::class, 'prices']);
});
