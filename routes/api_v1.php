<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'auth:sanctum'
], function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('auth')->group(function() {
        Route::post('register', [\App\Http\Api\V1\Auth\RegisterController::class, 'register']);
        Route::post('login', [\App\Http\Api\V1\Auth\LoginController::class, 'login']);
        Route::post('logout', [\App\Http\Api\V1\Auth\LogoutController::class, 'logout']);
    });

});