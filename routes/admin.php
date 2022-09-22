<?php

use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout_backend.master');
})->name('welcome');
Route::group([
    'as'     => 'users.',
    'prefix' => 'users',
], static function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/edit/{user?}', [UserController::class, 'edit'])->name('edit');
});

Route::group([
    'as'     => 'cars.',
    'prefix' => 'cars',
], static function () {
    Route::get('/', [CarController::class, 'index'])->name('index');
    Route::get('/create', [CarController::class, 'create'])->name('create');
    Route::post('/create', [CarController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [CarController::class, 'edit'])->name('edit');
    Route::put('/edit/{id}', [CarController::class, 'update'])->name('update');
});
Route::group([
    'as'     => 'bills.',
    'prefix' => 'bills',
], static function () {
    Route::get('/', [BillController::class, 'index'])->name('index');
    Route::get('/findCars', [CarController::class, 'findCars'])->name('find.cars');
    Route::get('/show/{id?}', [BillController::class, 'show'])->name('show');
    Route::get('/edit/{car?}', [BillController::class, 'edit'])->name('edit');
    Route::put('/edit/{car}', [BillController::class, 'update'])->name('update');
    Route::delete('/{bills}', [BillController::class, 'destroy'])->name('destroy');
});

