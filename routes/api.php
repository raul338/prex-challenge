<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GifController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->name('api.')
    ->group(function () {
        Route::get('/gif/search', [GifController::class, 'search'])->name('gif.search');
        Route::put('/user/{user}/gif', [GifController::class, 'save'])->name('gif.save');
    });

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
