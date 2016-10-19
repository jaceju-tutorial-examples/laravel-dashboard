<?php

use App\Jobs\UpdateBatteryState;
use Illuminate\Http\Request;

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

Route::post('/battery-state', function (Request $request) {
    $payload = $request->except('api_token');
    dispatch(app(UpdateBatteryState::class, [$payload]));
})->middleware('auth:api');