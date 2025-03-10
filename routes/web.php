<?php

use App\Http\Controllers\AirplaneController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\BookingIsAllowed;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', [FlightController::class, "index"])->name("index");
Route::get('/search', [FlightController::class, "search"])->name("search");
Route::get("/flight/{id}", [FlightController::class, "show"])->name("show")->middleware(BookingIsAllowed::class.":index");

Auth::routes();

Route::get("/flights", [FlightController::class, "flights"])->middleware("auth", IsAdmin::class.":web")->name("flights");
Route::get("/flights/create", [FlightController::class, "create"])->middleware("auth", IsAdmin::class.":web")->name("flightsCreate");
Route::post("/flights/create", [FlightController::class, "create"])->middleware("auth", IsAdmin::class.":web")->name("flightsCreate");
Route::get("/flights/{id}/edit", [FlightController::class, "edit"])->middleware("auth", IsAdmin::class.":web")->name("flightsEdit");
Route::post("/flights/{id}/edit", [FlightController::class, "edit"])->middleware("auth", IsAdmin::class.":web")->name("flightsEdit");

Route::get("/users", [UserController::class, "users"])->middleware(IsAdmin::class.":web")->name("users");
Route::get("/user/bookings", [UserController::class, "bookings"])->name("userBookings")->middleware(BookingIsAllowed::class.":index");

Route::get("/planes", [AirplaneController::class, "index"])->middleware(IsAdmin::class.":web")->name("planes");
Route::get("/planes/create", [AirplaneController::class, "create"])->middleware(IsAdmin::class.":web")->name("planesCreate");
Route::post("/planes/create", [AirplaneController::class, "create"])->middleware(IsAdmin::class.":web")->name("planesCreate");
Route::get("/planes/{id}/edit", [AirplaneController::class, "edit"])->middleware(IsAdmin::class.":web")->name("planesEdit");
Route::post("/planes/{id}/edit", [AirplaneController::class, "edit"])->middleware(IsAdmin::class.":web")->name("planesEdit");
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(IsAdmin::class.":web")->name('home');
