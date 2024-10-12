<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/register/resend', [AuthController::class, 'resendRegistrationMail']);
Route::post('/register/{verifiedToken}/completed/{userUuid}', [AuthController::class, 'registrationCompleted']);
Route::post('/refresh', [AuthController::class, 'refreshToken']);
Route::get('/verified/{token}', [AuthController::class, 'verified'])->name('verified')->withoutMiddleware('auth');

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'getMe']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
