<?php

use App\Http\Controllers\User\HomePageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect()->route('welcome');
})->name('welcome');

Route::get('/index', [HomePageController::class, 'index'])->name('index');
Route::post('/bill/create/{carId?}', [HomePageController::class, 'storeBill'])->name('bill.store');
