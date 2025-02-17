<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ActionIsAllowed;
use Illuminate\Support\Facades\Route;

Route::get('/', [FlightController::class, "index"])->name("index");
Route::get("/flights/{id}", [FlightController::class, "show"])->name("show")->middleware(ActionIsAllowed::class);

Auth::routes();

Route::get("/user/bookings", [UserController::class, "bookings"])->name("userBookings");
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
