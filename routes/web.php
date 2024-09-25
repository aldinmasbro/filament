<?php

use App\Http\Controllers\Popclock;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LandingPageController::class, 'index'])->name('landig-page');
Route::get('/scrape', [Popclock::class, 'scrape']);
