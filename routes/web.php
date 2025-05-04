<?php

use App\Http\Controllers\OwnersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CarController;
use App\Http\Middleware\Auth as CustomAuth;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\Shortcode;
use App\Http\Controllers\LanguageController;
use App\Http\Middleware\Language;

Route::get('/', function () {
    return view('home');
});

Auth::routes();
Route::middleware([Language::class])->group(function () {

Route::middleware([ShortCode::class])->group(function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('Language/{language}', [LanguageController::class, 'SwitchLanguage'])->name('Language');
Route::get('/owners', [OwnersController::class, 'index'])->name('owners.index');

Route::middleware([CustomAuth::class])->group(function () {
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');

Route::middleware([IsAdmin::class])->group(function () {
Route::get('/owners/create', [OwnersController::class, 'create'])->name('owners.create');
Route::post('/owners', [OwnersController::class, 'store'])->name('owners.store');
Route::get('/owners/{owner}/edit', [OwnersController::class, 'edit'])->name('owners.edit');
Route::put('/owners/{owner}/update', [OwnersController::class, 'update'])->name('owners.update');
Route::delete('/owners/{owner}/destroy', [OwnersController::class, 'destroy'])->name('owners.destroy');
Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');});});});});

