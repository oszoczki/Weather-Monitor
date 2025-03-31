<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('locations', LocationController::class);
