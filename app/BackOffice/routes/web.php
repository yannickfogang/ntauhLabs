<?php


use App\BackOffice\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name('dashboard.index');
