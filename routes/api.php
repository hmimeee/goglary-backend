<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ReviewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('info', function() {
    return settings_group('general', 'contact', 'social');
});

// Public API routes (read-only for frontend)
Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
Route::apiResource('brands', BrandController::class)->only(['index', 'show']);
Route::apiResource('products', ProductController::class)->only(['index', 'show']);
Route::apiResource('reviews', ReviewController::class)->only(['index', 'show']);

// Additional product routes
Route::get('products/search/{query}', [ProductController::class, 'search']);
Route::get('products/category/{category}', [ProductController::class, 'getByCategory']);
Route::get('products/brand/{brand}', [ProductController::class, 'getByBrand']);

// Additional review routes
Route::get('reviews/product/{productId}', [ReviewController::class, 'getByProduct']);
Route::get('reviews/user/{userId}', [ReviewController::class, 'getByUser']);
