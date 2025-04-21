<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WilayahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('api')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/login/google', [AuthController::class, 'loginWithGoogle']);
    Route::post('/login/facebook', [AuthController::class, 'loginWithFacebook']);

    Route::get('/provinces', [WilayahController::class, 'province']);
    Route::get('/province/{province_code}', [WilayahController::class, 'provinceByCode']);

    Route::get('/cities', [WilayahController::class, 'city']);
    Route::get('/city/{city_code}', [WilayahController::class, 'cityByCode']);
    Route::get('/cities/{province_code}', [WilayahController::class, 'citiesByProvinceCode']);

    Route::get('/districts', [WilayahController::class, 'district']);
    Route::get('/district/{district_code}', [WilayahController::class, 'districtByCode']);
    Route::get('/districts/{city_code}', [WilayahController::class, 'districtsByCityCode']);

    Route::get('/villages', [WilayahController::class, 'village']);
    Route::get('/village/{village_code}', [WilayahController::class, 'villageByCode']);
    Route::get('/villages/{district_code}', [WilayahController::class, 'villagesByDistrictCode']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);

        // Brand route
        Route::apiResource('brand', BrandController::class)
            ->except(['create', 'edit']);

        // Pengguna route
        Route::apiResource('pengguna', UserController::class)
            ->except(['create', 'store', 'edit', 'update', 'destroy']);

        // Item route
        Route::apiResource('items', ItemController::class)
            ->except(['create', 'store', 'edit', 'update', 'destroy']);
        Route::get('/items/user/{user_id}', [ItemController::class, 'userItem']);
    });
});
