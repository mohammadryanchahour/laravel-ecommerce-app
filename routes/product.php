<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Routes for Product Management
Route::get('/get-all-products', [ProductController::class, 'index']);
Route::middleware('auth:sanctum', 'admin')->post('/create-product', [ProductController::class, 'store']);
Route::get('/get-product/{id}', [ProductController::class, 'show']);
Route::middleware('auth:sanctum', 'admin')->put('/update-product/{id}', [ProductController::class, 'update']);
Route::middleware('auth:sanctum', 'admin')->delete('/delete-product/{id}', [ProductController::class, 'destroy']);






?>