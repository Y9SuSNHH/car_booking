<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('layout_backend.master');
})->name('welcome');
Route::group(['as'=> 'users.', 'prefix' => 'users',],function(){
    Route::get('/',[UserController::class,'index'])->name('index');
    Route::get('/{user}', [UserController::class, 'show'])->name('show');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});
Route::group(['prefix' => 'cars'], function(){
    Route::get('/', [CarController::class, 'index'])->name('cars.index');
    Route::get('/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/create', [CarController::class, 'store'])->name('cars.store');
    Route::get('/edit/{car}', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/edit/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/destroy/{car}', [CarController::class, 'destroy'])->name('cars.destroy');
});
