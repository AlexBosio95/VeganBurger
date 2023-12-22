<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\PartsController;
use App\Http\Controllers\Api\BraintreeController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/orders', [OrdersController::class, 'store'])->middleware('log.request');
Route::get('/parts', [PartsController::class, 'getAllParts']);
Route::get('/braintree/client-token', [BraintreeController::class, 'getClientToken']);
Route::post('/braintree/checkout', [BraintreeController::class, 'checkout']);


