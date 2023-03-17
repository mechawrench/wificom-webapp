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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user()->only(['name', 'email']);
});

// API v1
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::prefix('application')->group(function () {
        Route::post('/send_digirom', [\App\Http\Controllers\Api\V1\ApplicationController::class, 'send_digirom']);
        Route::post('/last_output', [\App\Http\Controllers\Api\V1\ApplicationController::class, 'last_output']);
        Route::post('/subscribers', [\App\Http\Controllers\Api\V1\ApplicationController::class, 'get_subscribers']);
        Route::post('/subscribers/{subscriber_uuid}', [\App\Http\Controllers\Api\V1\ApplicationController::class, 'get_subscriber']);
    });
});

// API V2
Route::prefix('v2')->group(function () {
    Route::prefix('application')->group(function () {
        Route::post('/send_digirom', [\App\Http\Controllers\Api\V2\ApplicationController::class, 'send_digirom']);
        Route::post('/last_output', [\App\Http\Controllers\Api\V2\ApplicationController::class, 'last_output']);
        // Route::post('/subscribers', [\App\Http\Controllers\Api\V1\ApplicationController::class, 'get_subscribers']);
        // Route::post('/subscribers/{subscriber_uuid}', [\App\Http\Controllers\Api\V1\ApplicationController::class, 'get_subscriber']);
    });
});