<?php


use Illuminate\Http\Request;
use App\Http\Controllers\ProductImageController;
use Illuminate\Support\Facades\Route;

// Routes for ProductImage Management
Route::get('/products/{productId}/images', [ProductImageController::class, 'index']);
Route::middleware('auth:sanctum', 'admin')->post('/products/{productId}/images', [ProductImageController::class, 'store']);
Route::get('/products/{productId}/images/{imageId}', [ProductImageController::class, 'show']);
Route::middleware('auth:sanctum', 'admin')->put('/products/{productId}/images/{imageId}', [ProductImageController::class, 'update']);
Route::middleware('auth:sanctum', 'admin')->delete('/products/{productId}/images/{imageId}', [ProductImageController::class, 'delete']);

?>