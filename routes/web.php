<?php

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('modules.home');
})->name('home');

Route::resource('locations', LocationController::class);
