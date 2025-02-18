<?php

use App\Http\Controllers\AirplaneController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\BookingIsAllowed;
use Illuminate\Support\Facades\Route;

Route::get('/', [FlightController::class, "index"])->name("index");
Route::get("/flights/{id}", [FlightController::class, "show"])->name("show")->middleware(BookingIsAllowed::class.":index");

Auth::routes();

Route::get("/user/bookings", [UserController::class, "bookings"])->name("userBookings")->middleware(BookingIsAllowed::class.":index");
Route::get("/planes", [AirplaneController::class, "index"])->name("planes");
Route::get("/planes/create", [AirplaneController::class, "create"])->name("planesCreate");
Route::post("/planes/create", [AirplaneController::class, "create"])->name("planesCreate");
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
