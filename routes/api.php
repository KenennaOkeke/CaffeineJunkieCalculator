<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GameApiController;

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

Route::apiResource('/game/{game}/config', GameApiController::class, ['as' => 'api'])->only(['index']); //Load I/O
Route::apiResource('/game/{game}/compute', GameApiController::class, ['as' => 'api'])->only(['store']); //Computer I and Output O
Route::apiResource('/game/{game}/page', GameApiController::class, ['as' => 'api'])->only(['index']); //Fetch a custom page