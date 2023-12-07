<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers;
use App\Http\Controllers\AuthController;

// Routes for Authentication
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protected routes that require authentication

Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
Route::get('me', [AuthController::class, 'me']);