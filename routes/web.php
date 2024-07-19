<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registrati', function () {
    return view('registrati');
})->name('registrati');

Route::get('/login', function () {
    return view('login');
})->name('login');