<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GamesController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function() {
    // Auth routes
	Route::post('logout', [AuthController::class, 'logout']);
	Route::post('refresh', [AuthController::class, 'refresh']);
	Route::post('me', [AuthController::class, 'me']);

	// Game routes
    Route::get('games', [GamesController::class, 'index']);
    Route::post('games', [GamesController::class, 'store']);
    Route::patch('games/{game}', [GamesController::class, 'update']);
});

