<?php

use Illuminate\Http\Request;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum', 'admin')->get('/get-all-orders', [OrderController::class, 'index']); // Get all orders
Route::middleware('auth:sanctum', 'admin')->get('/get-order/{id}', [OrderController::class, 'show']); // Get a specific order by ID
Route::middleware('auth:sanctum')->post('/place-order', [OrderController::class, 'store']); // Place a new order
Route::middleware('auth:sanctum')->put('/update-order/{id}', [OrderController::class, 'update']); // Update an existing order
Route::middleware('auth:sanctum')->delete('/remove-order/{id}', [OrderController::class, 'destroy']); // Delete an order

// Additional routes for order-related functionalities
Route::middleware('auth:sanctum')->get('/get-user-orders', [OrderController::class, 'userOrders']); // Get orders associated with the authenticated user
Route::middleware('auth:sanctum', 'admin')->put('/update-order/{id}/status', [OrderController::class, 'updateStatus']); // Update order status
Route::middleware('auth:sanctum')->post('/place-order/{id}/attach-product', [OrderController::class, 'attachProduct']); // Attach a product to an order
Route::middleware('auth:sanctum')->delete('/remove-order/{id}/detach-product', [OrderController::class, 'detachProduct']); // Detach a product from an order


?>