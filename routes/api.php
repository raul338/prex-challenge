<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GifController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::put('/user/{user}/gif', [GifController::class, 'save'])->name('api.gif.save');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
