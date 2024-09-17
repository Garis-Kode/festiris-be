<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Helpers\Router;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::prefix('v1')->group(function () {
    Route::group(['prefix' => 'auth'], function () {
        Router::includeFiles(__DIR__ . '/api/v1/Auth');
    });
});