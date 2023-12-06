<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

// Routes for Role Management (if applicable)
Route::get('/get-all-roles', [RoleController::class, 'index']);
Route::post('/create-role', [RoleController::class, 'store']);
Route::get('/get-role/id', [RoleController::class, 'show']);
Route::put('/update-role/id', [RoleController::class, 'update']);
Route::delete('/delete-role/id', [RoleController::class, 'destroy']);


?>