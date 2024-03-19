<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ErrorTypeController;
use App\Http\Controllers\Api\ReservationController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::post('/auth', [AuthController::class, 'login']);

    Route::get("/reservations", [ReservationController::class, 'index']);
    Route::post("/reservations", [ReservationController::class, 'store']);

    Route::get("/error-types", [ErrorTypeController::class, 'index']);
});


