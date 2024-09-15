<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register'])->withoutMiddleware('auth');
    Route::get('/verified/{token}', [AuthController::class, 'verified'])->name('verified')->withoutMiddleware('auth');
});