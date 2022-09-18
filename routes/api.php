<?php


use App\Http\Controllers\CarController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\User\BillController;
use Illuminate\Support\Facades\Route;

Route::get('/cars', [CarController::class, 'index'])->name('cars');
Route::get('/cars/show/{carId?}', [CarController::class, 'show'])->name('cars.show');
Route::get('/cars/slug', [CarController::class, 'checkSlug'])->name('cars.slug.check');
Route::post('/cars/slug', [CarController::class, 'generateSlug'])->name('cars.slug.generate');
Route::post('/bills/create/{car?}', [BillController::class, 'store'])->name('bills.store');
