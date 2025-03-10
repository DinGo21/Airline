<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\AirplaneController;
use App\Http\Middleware\IsAdmin;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});



Route::post("/airplanes", [AirplaneController::class, "store"])->middleware(['auth:api', IsAdmin::class.":api"])->name("apiairplanestore");
Route::get("/airplanes", [AirplaneController::class, "index"])->middleware('auth:api')->name("apiairplaneindex");
Route::get("/airplanes/{id}", [AirplaneController::class, "show"])->middleware('auth:api')->name("apiairplaneshow");
Route::put("/airplanes/{id}", [AirplaneController::class, "update"])->middleware(['auth:api', IsAdmin::class.":api"])->name("apiairplaneupdate");
Route::delete("/airplanes/{id}", [AirplaneController::class, "destroy"])->middleware(['auth:api', IsAdmin::class.":api"])->name("apiairplanedestroy");

Route::post("/flights", [FlightController::class, "store"])->middleware(['auth:api', IsAdmin::class.":api"])->name("apiflightstore");
Route::get("/flights", [FlightController::class, "index"])->middleware('auth:api')->name("apiflightindex");
Route::get("/flights/{id}", [FlightController::class, "show"])->middleware('auth:api')->name("apiflightshow");
Route::put("/flights/{id}", [FlightController::class, "update"])->middleware(['auth:api', IsAdmin::class.":api"])->name("apiflightupdate");
Route::delete("/flights/{id}", [FlightController::class, "destroy"])->middleware(['auth:api', IsAdmin::class.":api"])->name("apiflightdestroy");
