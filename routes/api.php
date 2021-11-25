<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\AuthenticationController;
use \App\Http\Controllers\Api\ExchangeController;
use \App\Http\Controllers\Api\DashboardController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[AuthenticationController::class,'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('send-money',[ExchangeController::class,'transferMoney']);
    Route::get('total-transaction',[DashboardController::class,'totalTransfer']);
    Route::get('third-transaction',[DashboardController::class,'thirdTransfer']);
    Route::get('most-transaction',[DashboardController::class,'mostTransfer']);
});
