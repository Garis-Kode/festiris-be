<?php

use App\Helpers\Router;
use App\Http\Middleware\OnlyAcceptJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::group(['middleware' => OnlyAcceptJson::class], function () {
    Route::prefix('v1')->group(function () {
        Route::group(['prefix' => 'auth'], function () {
            Router::includeFiles(__DIR__.'/api/v1/Auth');
        });
    });
});
