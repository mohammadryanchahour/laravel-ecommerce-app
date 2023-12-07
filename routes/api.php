<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\AuthController;

require __DIR__.'/user.php';
require __DIR__.'/role.php';
require __DIR__.'/auth.php';

// Route::middleware('auth:sanctum')->get('user', function(Request $request){
//     return $request->user();
// });


    
// // Other authenticated routes can be added here
// Route::middleware('auth:sanctum', 'admin')->prefix('admin')->group(function () {
//     Route::get('/users', [UserController::class, 'index']);
//     Route::put('/admin/users/{user}', [UserController::class, 'update'])->middleware('isAdmin');
//     Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->middleware('isAdmin');
// });

