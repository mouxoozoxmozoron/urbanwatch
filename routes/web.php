<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'Home'])->name('home');
Route::get('/about', [HomeController::class, 'About'])->name('about');
Route::get('/contact', [HomeController::class, 'Contact'])->name('contact');

Route::get('/account', [HomeController::class, 'newuseraccount'])->name('account');
Route::post('/create-account', [HomeController::class, 'createAccount'])->name('create_account');
Route::post('/subscribe', [HomeController::class, 'CreateSubscription'])->name('subscribe');

Route::get('/defaultlogin', [HomeController::class, 'defaultlogin'])->name('defaultlogin');
Route::post('/defaultauth', [HomeController::class, 'authenticate'])->name('defaultauth');


Route::post('/report_incidence', [HomeController::class, 'SaveIncidence'])->name('report_incidence');
Route::get('/logout', [HomeController::class, 'Logout'])->name('logout');
Route::get('login', function () {
    return view('backend.default');
})->name('login');
Route::post('logincheck', [DashboardController::class, 'LoginCheck'])->name('authentication');


Route::middleware('auth')->group(function () {
    Route::get('/report-incidence', [HomeController::class, 'RepoRtIncidence'])->name('report-incidence');

    Route::get('myprofile', [DashboardController::class, 'MyProfile'])->name('myprofile');
    Route::post('updateprofile', [DashboardController::class, 'UpdateProfile'])->name('updateprofile');
    Route::post('updatepassword', [DashboardController::class, 'UpdatePassword'])->name('updatepassword');

    Route::get('dashboard', [DashboardController::class, 'DashboardHome'])->name('dashboard');
    Route::get('incidences', [DashboardController::class, 'ReportedIncidences'])->name('incidences');
    Route::get('resolved-issues', [DashboardController::class, 'resolvedIssues'])->name('resolved-issues');
    Route::get('un-resolved-issues', [DashboardController::class, 'unresolvedIssues'])->name('un-resolved-issues');

    Route::post('update-incidence-images', [HomeController::class, 'updateImagesForIncidence'])->name('updateincidenceimages');



    Route::get('compay-incidences/{id}', [DashboardController::class, 'CompanyIncidence'])->name('compay-incidences');
    Route::get('consultancy', [DashboardController::class, 'Consultant'])->name('consultancy');
    Route::get('my-company', [DashboardController::class, 'MyCompany'])->name('my-company');
    Route::get('system-managers', [DashboardController::class, 'SystemManger'])->name('system-managers');
    Route::get('consultancy-managers', [DashboardController::class, 'Managers'])->name('consultancy-managers');
    Route::post('addconsultant', [DashboardController::class, 'AddCompany'])->name('addconsultant');
    Route::post('add-admin', [DashboardController::class, 'addCompanyAdmin'])->name('add.admin');
    Route::post('add-system_admin', [DashboardController::class, 'addSystemManager'])->name('add.system_admin');

    Route::post('assign-consultant', [DashboardController::class, 'assignConsultant'])->name('assignconsultanttoincidence');
    Route::post('updateincidencestatus', [DashboardController::class, 'updateIncidentStatus'])->name('updateincidencestatus');
    Route::post('re-asignincidenceconsultant', [DashboardController::class, 'reassignOrRemoveConsultant'])->name('reassignincidenceconsultant');

    Route::get('incidencepreview/{id}', [DashboardController::class, 'IncidencePreview'])->name('incidencepreview');

    });



