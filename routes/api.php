<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/cars', [CarController::class, 'index'])->name('cars');
Route::get('/cars/each/{carId?}', [CarController::class, 'each'])->name('cars.each');
Route::get('/cars/list', [CarController::class, 'list'])->name('cars.list');
Route::get('/cars/slug', [CarController::class, 'checkSlug'])->name('cars.slug.check');
Route::post('/cars/slug', [CarController::class, 'generateSlug'])->name('cars.slug.generate');
Route::get('/bills/create', [BillController::class, 'store'])->name('bills.store');
