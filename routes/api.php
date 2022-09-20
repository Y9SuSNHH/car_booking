<?php


use App\Http\Controllers\CarController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\User\BillController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users/show-image/{user?}', [UserController::class, 'showImage'])->name('users.show.image');
Route::put('/users/edit/{user}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/identity/status', [UserController::class, 'identityStatusUpdate'])->name('users.identity.status.update');
Route::get('/users/license-car/status', [UserController::class, 'licenseCarStatusUpdate'])->name('users.license.car.status.update');

Route::get('/cars', [CarController::class, 'index'])->name('cars');
Route::get('/cars/show/{carId?}', [CarController::class, 'show'])->name('cars.show');
Route::get('/cars/slug', [CarController::class, 'checkSlug'])->name('cars.slug.check');
Route::post('/cars/slug', [CarController::class, 'generateSlug'])->name('cars.slug.generate');

Route::post('/bills/create/{car?}', [BillController::class, 'store'])->name('bills.store');
