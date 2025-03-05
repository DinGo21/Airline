<?php

use App\Http\Controllers\AirplaneController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\BookingIsAllowed;
use Illuminate\Support\Facades\Route;

Route::get('/', [FlightController::class, "index"])->name("index");
Route::get('/search', [FlightController::class, "search"])->name("search");
Route::get("/flight/{id}", [FlightController::class, "show"])->name("show")->middleware(BookingIsAllowed::class.":index");

Auth::routes();

Route::get("/flights", [FlightController::class, "flights"])->name("flights");
Route::get("/flights/create", [FlightController::class, "create"])->name("flightsCreate");
Route::post("/flights/create", [FlightController::class, "create"])->name("flightsCreate");
Route::get("/flights/{id}/edit", [FlightController::class, "edit"])->name("flightsEdit");
Route::post("/flights/{id}/edit", [FlightController::class, "edit"])->name("flightsEdit");

Route::get("/users", [UserController::class, "users"])->name("users");
Route::get("/user/bookings", [UserController::class, "bookings"])->name("userBookings")->middleware(BookingIsAllowed::class.":index");

Route::get("/planes", [AirplaneController::class, "index"])->name("planes");
Route::get("/planes/create", [AirplaneController::class, "create"])->name("planesCreate");
Route::post("/planes/create", [AirplaneController::class, "create"])->name("planesCreate");
Route::get("/planes/{id}/edit", [AirplaneController::class, "edit"])->name("planesEdit");
Route::post("/planes/{id}/edit", [AirplaneController::class, "edit"])->name("planesEdit");
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
