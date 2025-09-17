<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/surat', SuratController::class);
Route::resource('/kategori', KategoriController::class);
Route::get('/surat/download/{id}', [SuratController::class, 'download']);
Route::view('/about', 'about');
