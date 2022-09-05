<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\BillController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect()->route('welcome');
})->name('welcome');

Route::get('/index', [UserController::class, 'index'])->name('index');
Route::post('/bill/create/{carId?}', [BillController::class, 'store'])->name('bill.store');
