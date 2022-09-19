<?php

use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('layout_backend.master');
})->name('welcome');
Route::group([
    'as'     => 'users.',
    'prefix' => 'users',
], static function() {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/{user}', [UserController::class, 'show'])->name('show');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
});

Route::group([
    'as'     => 'cars.',
    'prefix' => 'cars',
], static function() {
    Route::get('/', [CarController::class, 'index'])->name('index');
    Route::get('/create', [CarController::class, 'create'])->name('create');
    Route::post('/create', [CarController::class, 'store'])->name('store');
    Route::get('/edit/{car}', [CarController::class, 'edit'])->name('edit');
    Route::put('/edit/{car}', [CarController::class, 'update'])->name('update');
    Route::delete('/{car}', [CarController::class, 'destroy'])->name('destroy');

});
Route::group([
    'as'     => 'bills.',
    'prefix' => 'bills',
], static function() {
    Route::get('/', [BillController::class, 'index'])->name('index');
    Route::get('/findCars', [CarController::class, 'findCars'])->name('find.cars');
    Route::get('/create/{car}', [BillController::class, 'create'])->name('create');
    Route::post('/create/{car}', [BillController::class, 'store'])->name('store');
});

