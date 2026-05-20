<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailDashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Mail Dashboard routes
Route::get('/mail-dashboard', [MailDashboardController::class, 'index'])->name('mail.dashboard');
Route::get('/mail-test', [MailDashboardController::class, 'sendTest'])->name('mail.test');