<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mail-dashboard', [MailDashboardController::class, 'index'])->name('mail.dashboard');
Route::get('/mail-test', [MailDashboardController::class, 'sendTest'])->name('mail.test');
Route::post('/mail-schedule', [MailDashboardController::class, 'scheduleEmail'])->name('mail.schedule');
Route::get('/mail-analytics', [MailDashboardController::class, 'getAnalytics'])->name('mail.analytics');
Route::get('/mail-track/{id}', [MailDashboardController::class, 'track'])->name('mail.track');