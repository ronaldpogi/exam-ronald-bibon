<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OptionController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'permission'])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('employees', EmployeeController::class);

    // OPTIONS CONTROLLER DESIGN FOR FETCHING DROP-DOWNS FOR FE
    Route::prefix('options')->group(function () {
        Route::get('/positons', [OptionController::class, 'positions'])->name('options.position');
        Route::get('/roles', [OptionController::class, 'roles'])->name('options.roles');
    });
});
