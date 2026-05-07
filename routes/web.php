<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailDashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/mail-dashboard', [MailDashboardController::class, 'index']);