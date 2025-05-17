<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'Home'])->name('home');
Route::get('/about', [HomeController::class, 'About'])->name('about');
Route::get('/contact', [HomeController::class, 'Contact'])->name('contact');
Route::get('/report-incidence', [HomeController::class, 'RepoRtIncidence'])->name('report-incidence');
Route::post('/report_incidence', [HomeController::class, 'SaveIncidence'])->name('report_incidence');
Route::get('/logout', [HomeController::class, 'Logout'])->name('logout');
Route::get('login', function () {
    return view('backend.default');
})->name('login');
Route::post('logincheck', [DashboardController::class, 'LoginCheck'])->name('authentication');


Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'DashboardHome'])->name('dashboard');

    });
