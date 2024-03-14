<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GifController;
use App\Http\Middleware\LogServicesMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])
    ->middleware(LogServicesMiddleware::class)
    ->name('api.login');

Route::middleware('auth:sanctum')
    ->name('api.')
    ->middleware(LogServicesMiddleware::class)
    ->group(function () {
        Route::get('/gif/search', [GifController::class, 'search'])->name('gif.search');
        Route::get('/gif/{id}', [GifController::class, 'show'])
            ->name('gif.show')
            ->where('id', '[a-zA-Z0-9]+');
        Route::put('/user/{user}/gif', [GifController::class, 'save'])->name('gif.save');
    });

