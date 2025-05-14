<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'Home'])->name('home');
Route::get('/about', [HomeController::class, 'About'])->name('about');
Route::get('/contact', [HomeController::class, 'Contact'])->name('contact');
Route::get('/report-incidence', [HomeController::class, 'RepoRtIncidence'])->name('report-incidence');
