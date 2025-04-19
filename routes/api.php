<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('api')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/login/google', [AuthController::class, 'loginWithGoogle']);
    Route::post('/login/facebook', [AuthController::class, 'loginWithFacebook']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::apiResource('brand', BrandController::class)
            ->except(['create', 'edit']);
        Route::apiResource('pengguna', UserController::class)
            ->except(['create', 'store', 'edit', 'update', 'destroy']);
    });
});
