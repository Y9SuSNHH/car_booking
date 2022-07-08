<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::get('/cars', [CarController::class, 'index'])->name('cars');
Route::get('/bills/create', [BillController::class, 'store'])->name('bills.store');
