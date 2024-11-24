<?php

use App\Http\Controllers\KonsultasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\TenagaLayananController;
use App\Http\Controllers\TenagaProviderController;

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

Route::get('/tenaga', [TenagaProviderController::class, 'index'])->name('tenaga.index');
Route::get('/tenaga/{category}', [TenagaProviderController::class, 'getSpesialis'])->name('tenaga.getSpesialis');


Route::get('/tenaga-layanan', [TenagaLayananController::class, 'index'])->name('tenaga-layanan.index');
Route::get('/tenaga-layanan/{category}', [TenagaLayananController::class, 'getLayanan'])->name('tenaga-layanan.getLayanan');


Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.index');
Route::get('/getProvinsi', [KonsultasiController::class, 'getProvinsi']);
Route::get('/getKlinik', [KonsultasiController::class, 'getKlinik']);

Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi.index');

Route::get('/history-konsultasi', function () {
    return view('history-konsultasi');
});
