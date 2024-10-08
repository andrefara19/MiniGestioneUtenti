<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\EventController;
use App\Http\Controllers\Auth\SubscriptionController;
use App\Models\Subscription;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::get('/countries', [RegisterController::class, 'getCountries']);
});

Route::get('registrati', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('registrati', [RegisterController::class, 'register']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/area_personale', [HomeController::class, 'index'])->name('home');

    Route::get('/profilo', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profilo', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/utente/{id}', [UserController::class, 'show'])->name('user.profile');
    Route::put('/utente/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/utente/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/eventi', [EventController::class, 'allEvents'])->name('event.index');
    Route::get('/eventi/user/{user_id}', [EventController::class, 'myEvents'])->name('event.index.user');
    Route::get('/eventi/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/eventi/store', [EventController::class, 'store'])->name('event.store');
    Route::get('/eventi/{id}', [EventController::class, 'edit'])->name('event.edit');
    Route::put('/eventi/{id}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/eventi/{id}', [EventController::class, 'destroy'])->name('event.delete');

    Route::get('/iscrizioni/create/{id}', [SubscriptionController::class, 'create'])->name('subscriptions.create');
    Route::post('/iscrizioni/store', [SubscriptionController::class, 'store'])->name('subscriptions.store');
});