<?php

use App\Http\Controllers\FlightController;
use App\Http\Middleware\ActionIsAllowed;
use Illuminate\Support\Facades\Route;

Route::get('/', [FlightController::class, "index"])->name("index");
Route::get("/flights/{id}", [FlightController::class, "show"])->name("show")->middleware(ActionIsAllowed::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
