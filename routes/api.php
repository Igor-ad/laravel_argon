<?php

use App\Http\Controllers\Api\TrackingController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware(['auth:api'])->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/show/{user}', [UserController::class, 'show']);
    Route::get('/user/apiadd', [UserController::class, 'apiadd']);
    Route::get('/user/del/{user}', [UserController::class, 'del']);
    Route::get('/track', [TrackingController::class, 'tracking'])->name('tracking');
});
