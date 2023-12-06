<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Routes for User Management
Route::middleware('auth:sanctum', 'admin')->get('/get-all-users', [UserController::class, 'index']);
Route::post('/create-user', [UserController::class, 'store']);
Route::get('/get-user/id', [UserController::class, 'show']);
Route::put('/update-user/id', [UserController::class, 'update']);
Route::delete('/delete-user/id', [UserController::class, 'destroy']);






?>