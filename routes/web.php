<?php

use App\Http\Controllers\OwnersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
