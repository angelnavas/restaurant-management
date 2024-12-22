<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;

Route::prefix('api')->group(function () {
    // Recipes
    Route::get('/recipes', [RecipeController::class, 'index']);
    Route::post('/recipes', [RecipeController::class, 'store']);
    Route::get('/recipes/analytics', [RecipeController::class, 'analytics']);

    // Products
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);

    // Sales
    Route::post('/sales', [SaleController::class, 'store']);
    Route::get('/sales/analytics', [SaleController::class, 'analytics']);
});