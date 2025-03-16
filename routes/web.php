<?php

use App\Http\Controllers\OwnersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CarController;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/owners', [OwnersController::class, 'index'])->name('owners');
    Route::get('/owners/create', [OwnersController::class, 'create'])->name('create');
    Route::post('/owners', [OwnersController::class, 'store'])->name('store');
    Route::get('/owners/{owner}/edit', [OwnersController::class, 'edit'])->name('edit');
    Route::put('/owners/{owner}/update', [OwnersController::class, 'update'])->name('update');
    Route::delete('/owners/{owner}/destroy', [OwnersController::class, 'destroy'])->name('destroy');
});

Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');
