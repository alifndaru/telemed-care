<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});
Route::get('/tenaga', function () {
    return view('tenaga-layanan');
});

Route::get('/tenaga-provider', function () {
    return view('tenaga-provider');
});


