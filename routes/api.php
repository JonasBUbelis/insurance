<?php

use App\Http\Controllers\OwnerAPI;
use App\Http\Controllers\CarAPI;
use Illuminate\Support\Facades\Route;

Route::get('/owners', [OwnerAPI::class, "index"]);
Route::get('/owners/{owner}', [OwnerAPI::class, "show"]);
Route::post('/owners', [OwnerAPI::class, "store"]);
Route::put('/owners/{owner}', [OwnerAPI::class, "update"]);
Route::delete('/owners/{owner}', [OwnerAPI::class, "destroy"]);

Route::get('/cars', [CarAPI::class, "index"]);
Route::get('/cars/{car}', [CarAPI::class, "show"]);
Route::post('/cars', [CarAPI::class, "store"]);
Route::put('/cars/{car}', [CarAPI::class, "update"]);
Route::delete('/cars/{car}', [CarAPI::class, "destroy"]);

