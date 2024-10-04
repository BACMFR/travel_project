<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TravelController;
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
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/users', [AdminUserController::class, 'create']);
Route::get('travels', [TravelController::class, 'index']);
Route::get('travels/{travel:slug}/tours', [TourController::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::middleware('auth:sanctum')->post('/travel', [TravelController::class, 'create']);
    Route::middleware('auth:sanctum')->post('/tour', [TourController::class, 'create']);
    Route::middleware('auth:sanctum')->put('tours/{tour}', [TourController::class, 'update']);
    Route::middleware('auth:sanctum')->put('travels/{travel}', [TravelController::class, 'update']);
});
