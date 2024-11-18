<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LokasiController;


Route::get('/', function () {
    return view('homepage');
});

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

Route::get('/register', function () {
    return view('pages.auth.register');
})->name('register');

Route::get('/chat', function () {
    return view('pages.chat.index');
})->name('chat');

Route::get('/tenaga', function () {
    return view('tenaga-layanan');
});

Route::get('/tenaga-provider', function () {
    return view('tenaga-provider');
});

Route::get('/konsultasi', function () {
    return view('konsultasi');
});

Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi.index');

Route::get('/history-konsultasi', function () {
    return view('history-konsultasi');
});
