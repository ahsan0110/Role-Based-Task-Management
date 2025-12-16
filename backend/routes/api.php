<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    // ✅ Auth
    Route::post('/logout', [AuthController::class, 'logout']);

    // ✅ Tasks (View for all logged-in users)
    Route::get('/tasks', [TaskController::class, 'index']);

    // ✅ Admin-only actions
    Route::post('/tasks', [TaskController::class, 'store'])
        ->middleware('role:admin');

    Route::put('/tasks/{id}', [TaskController::class, 'update'])
        ->middleware('role:admin');

    // ✅ User-only action (status update)
    Route::patch('/tasks/{id}/status', [TaskController::class, 'updateStatus'])
        ->middleware('role:user');
});

/*
|--------------------------------------------------------------------------
| TEST ROUTE
|--------------------------------------------------------------------------
*/
Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});
