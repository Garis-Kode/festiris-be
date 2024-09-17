<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::get('/verified/{token}', [AuthController::class, 'verified'])->name('verified')->withoutMiddleware('auth');