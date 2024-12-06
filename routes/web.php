<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KonsultasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\TenagaLayananController;
use App\Http\Controllers\TenagaProviderController;
// use App\Livewire\Konsultasi;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/feedback', function () {
    return view('homepage');
})->name('feedback');


Route::middleware(['auth', 'role:panel_user'])->group(function () {
    Route::get('/konsultasi-list', function () {
        return view('pages.konsultasi.list');
    })->name('konsultasi.list');

    Route::get('/konsultasi-create', function () {
        return view('pages.konsultasi.create');
    })->name('konsultasi.create');

    Route::get('/konsultasi-histori', function () {
        return view('pages.konsultasi.histori');
    })->name('histori.konsultasi');
});


Route::get('/konsultasi-chat', function () {
    return view('pages.chat-dokter');
})->name('konsultasi.chat');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/chat', function () {
    return view('pages.chat.index');
})->name('chat');

Route::get('/tenaga', [TenagaProviderController::class, 'index'])->name('tenaga.index');
Route::get('/tenaga/{category}', [TenagaProviderController::class, 'getSpesialis'])->name('tenaga.getSpesialis');

Route::get('/tenaga-layanan', [TenagaLayananController::class, 'index'])->name('tenaga-layanan.index');
Route::get('/tenaga-layanan/{category}', [TenagaLayananController::class, 'getLayanan'])->name('tenaga-layanan.getLayanan');

Route::get('/getProvinsi', [KonsultasiController::class, 'getProvinsi']);
Route::get('/getKlinik', [KonsultasiController::class, 'getKlinik']);
Route::get('/getProvider', [KonsultasiController::class, 'getProvider']);
Route::get('/getTarif', [KonsultasiController::class, 'getTarif']);
Route::post('/sendData', [KonsultasiController::class, 'sendData']);

Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi');
