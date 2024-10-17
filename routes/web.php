<?php

use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LandingPageController::class, 'index'])->name('home');

// datasiswa
Route::prefix('index-data')->name('index_data.')->group(function () {
    Route::get('/', [DataSiswaController::class, 'index'])->name('index');
    Route::get('/create', [DataSiswaController::class, 'create'])->name('create');
    Route::post('/create/form', [DataSiswaController::class, 'store'])->name('proses');
    Route::get('/{id}/edit', [DataSiswaController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [DataSiswaController::class, 'update'])->name('update');
    Route::delete('/{id}', [DataSiswaController::class, 'destroy'])->name('delete');
});

// kelola akun
Route::prefix('kelola-akun')->name('kelola_akun.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/create/form', [UserController::class, 'store'])->name('proses');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('delete');
});
