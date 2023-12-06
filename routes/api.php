<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\AuthController;

require __DIR__.'/user.php';
require __DIR__.'/role.php';

Route::middleware('auth:sanctum')->get('user', function(Request $request){
    return $request->user();
});

// Routes for Authentication
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protected routes that require authentication

Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
Route::get('me', [AuthController::class, 'me']);
    
// // Other authenticated routes can be added here
// Route::middleware('auth:sanctum', 'admin')->prefix('admin')->group(function () {
//     Route::get('/users', [UserController::class, 'index']);
//     Route::put('/admin/users/{user}', [UserController::class, 'update'])->middleware('isAdmin');
//     Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->middleware('isAdmin');
// });

