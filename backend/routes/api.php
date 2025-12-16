<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// -----------------------
// Public routes
// -----------------------
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// -----------------------
// Protected routes (authenticated users only)
// -----------------------
Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // -----------------------
    // Task routes
    // -----------------------
    Route::get('/tasks', [TaskController::class, 'index']); // anyone logged in
    Route::get('/tasks/{id}', [TaskController::class, 'show']); // anyone logged in

    // Only admin can create, update, delete tasks
    Route::middleware('role:admin')->group(function () {
        Route::post('/tasks', [TaskController::class, 'store']);
        Route::put('/tasks/{id}', [TaskController::class, 'update']);
        Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
    });

    // -----------------------
    // User routes
    // -----------------------
    Route::get('/users', [UserController::class, 'index']); // admin only
    Route::get('/users/{id}', [UserController::class, 'show']); // admin only
    Route::middleware('role:admin')->group(function () {
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
    });
});
