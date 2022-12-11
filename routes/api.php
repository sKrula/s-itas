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

Route::post('register', [\App\Http\Controllers\Api\V1\AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    // Route::get('user', [\App\Http\Controllers\Api\V1\AuthController::class, 'user']);
    // Route::post('logout', [\App\Http\Controllers\Api\V1\AuthController::class, 'logout']);
    //Route::apiResource('logins', \App\Http\Controllers\Api\V1\LoginController::class);
    //Route::apiResource('customers', \App\Http\Controllers\Api\V1\CustomerController::class);
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', [\App\Http\Controllers\Api\V1\AuthController::class, 'login']);
    Route::post('logout', [\App\Http\Controllers\Api\V1\AuthController::class, 'logout']);
    Route::post('refresh', [\App\Http\Controllers\Api\V1\AuthController::class, 'refresh']);
    Route::post('me', [\App\Http\Controllers\Api\V1\AuthController::class, 'me']);
    Route::apiResource('wallets',\App\Http\Controllers\Api\V1\WalletController::class);
    Route::apiResource('logins', \App\Http\Controllers\Api\V1\LoginController::class);
    Route::apiResource('customers', \App\Http\Controllers\Api\V1\CustomerController::class);

});

Route::middleware('auth:sanctum', 'isUser')->group(function () {
    //Route::apiResource('user/customers', \App\Http\Controllers\Api\V1\CustomerController::class);
});

// api/v1
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function() {
    //Route::apiResource('customers', CustomerController::class);
    //Route::apiResource('wallets', WalletController::class);
    //Route::apiResource('logins', LoginController::class);
});
