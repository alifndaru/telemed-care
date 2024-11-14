<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

Route::get('/register', function () {
    return view('pages.auth.register');
})->name('register');

Route::get('/tenaga', function () {
    return view('tenaga-layanan');
});

Route::get('/tenaga-provider', function () {
    return view('tenaga-provider');
});

Route::get('/lokasi', function () {
    return view('lokasi');
});
