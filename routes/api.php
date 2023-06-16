<?php

use App\Http\Controllers\Api\Auth;
use App\Http\Controllers\Api\NotesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [Auth::class, 'login']);
        Route::post('register', [Auth::class, 'register']);
        Route::middleware('auth:api')->group(function () {
            Route::post('profile', [Auth::class, 'profile']);
            Route::post('profile/update', [Auth::class, 'updateProfile']);
            Route::post('logout', [Auth::class, 'logout']);
        });
    });
    Route::prefix('notes')->group(function () {
        Route::get('', [NotesController::class, 'index']);
        Route::get('{id}', [NotesController::class, 'show']);
        Route::post('', [NotesController::class, 'store']);
        Route::put('{id}', [NotesController::class, 'update']);
        Route::delete('{id}', [NotesController::class, 'destroy']);
    });
});
