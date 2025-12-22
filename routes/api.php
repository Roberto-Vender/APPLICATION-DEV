<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProgressController;
use App\Http\Controllers\UserStatusController;
use App\Http\Controllers\RiddleController;
use App\Http\Controllers\LogicController;
use App\Http\Controllers\EnduranceController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/riddles', [RiddleController::class, 'index']);
Route::get('/logic/generate', [LogicController::class, 'generate']);
Route::match(['get', 'post'], '/endurance/generate', [EnduranceController::class, 'generate']);

/*
|--------------------------------------------------------------------------
| Protected Routes (Sanctum)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/leaderboard', [UserController::class, 'getLeaderboard']);

    Route::get('/progress/{gameMode}', [UserProgressController::class, 'show']);
    Route::post('/progress/{gameMode}', [UserProgressController::class, 'update']);
    Route::post('/progress/{gameMode}/reset', [UserProgressController::class, 'reset']);

    Route::prefix('user-status')->group(function () {
        Route::get('/points', [UserStatusController::class, 'getPoints']);
        Route::post('/points/add', [UserStatusController::class, 'addPoints']);
        Route::post('/points/deduct', [UserStatusController::class, 'deductPoints']);
        Route::post('/points/game', [UserStatusController::class, 'addGamePoints']);
        Route::post('/points/reset', [UserStatusController::class, 'resetPoints']);
    });

    Route::get('/test-auth', function (Request $request) {
        return response()->json([
            'message' => 'Authentication working',
            'user' => $request->user()
        ]);
    });
});
