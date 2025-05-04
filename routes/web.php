<?php

use App\Http\Controllers\OwnersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CarController;
use App\Http\Middleware\Auth as CustomAuth;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\Shortcode;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::middleware([ShortCode::class])->group(function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/owners', [OwnersController::class, 'index'])->name('owners.index');

Route::middleware([CustomAuth::class])->group(function () {
Route::get('/owners/create', [OwnersController::class, 'create'])->name('owners.create');
Route::post('/owners', [OwnersController::class, 'store'])->name('owners.store');
Route::get('/owners/{owner}/edit', [OwnersController::class, 'edit'])->name('owners.edit');
Route::put('/owners/{owner}/update', [OwnersController::class, 'update'])->name('owners.update');
Route::delete('/owners/{owner}/destroy', [OwnersController::class, 'destroy'])->name('owners.destroy');
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');});});

Route::resource('/cars/{car}/cars', CarController::class)->only('cars.edit')->middleware(IsAdmin::class);
Route::resource('owners/{owner}/owners', CarController::class)->only('owners.edit')->middleware(IsAdmin::class);
