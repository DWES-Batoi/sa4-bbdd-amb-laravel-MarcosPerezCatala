<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JugadoraController;

Route::name('api.')->group(function () {

    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::apiResource('jugadores', JugadoraController::class)
            ->parameters(['jugadores' => 'jugadora'])
            ->except(['index', 'show']);

        Route::apiResource('equips', \App\Http\Controllers\Api\EquipController::class)
            ->except(['index', 'show'])
            ->parameters(['equips' => 'equip']);

        Route::get('/user', function (Request $request) {
            return $request->user();
        })->name('user');
    });

    Route::apiResource('jugadores', JugadoraController::class)
        ->parameters(['jugadores' => 'jugadora'])
        ->only(['index', 'show']);

    Route::apiResource('equips', \App\Http\Controllers\Api\EquipController::class)
        ->only(['index', 'show'])
        ->parameters(['equips' => 'equip']);

});
