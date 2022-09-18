<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\BillController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect()->route('welcome');
})->name('welcome');

Route::get('/index', [UserController::class, 'index'])->name('index');
Route::get('/edit', [UserController::class, 'edit'])->name('edit');
Route::put('/edit', [UserController::class, 'update'])->name('update');
