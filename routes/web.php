<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\Auth\ProfileController;

use Illuminate\Support\Facades\Route;

Route::get('registrati', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('registrati', [RegisterController::class, 'register']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/area_personale', [HomeController::class, 'index'])->name('home');
    Route::get('/profilo', [ProfileController::class, 'index'])->name('profile');
});