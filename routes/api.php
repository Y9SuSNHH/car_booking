<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/cars', [CarController::class, 'index'])->name('cars');
Route::get('/cars/slug', [CarController::class, 'checkSlug'])->name('cars.slug.check');
Route::post('/cars/slug', [CarController::class, 'generateSlug'])->name('cars.slug.generate');
Route::get('/files/cars/{carId?}', [FileController::class, 'carImage'])->name('files.cars.carImage');
Route::get('/bills/create', [BillController::class, 'store'])->name('bills.store');
