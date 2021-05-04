<?php


use App\FrontOffice\Http\Controllers\Auth\LoginController;
use App\FrontOffice\Http\Controllers\Auth\LogoutController;
use App\FrontOffice\Http\Controllers\Auth\RegisterController;
use App\FrontOffice\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/logout', LogoutController::class)->name('logout');

Route::post('/register', [RegisterController::class, 'saveUser'])->name('user.save');
Route::post('/login', [LoginController::class, 'saveLogin'])->name('user.login');
