<?php

use App\Http\Controllers\FlightController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FlightController::class, "index"])->name("index");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
