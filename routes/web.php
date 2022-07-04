<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/













Route::group(['prefix' => 'cars'], function(){
    Route::get('/', [CarController::class, 'index'])->name('cars.index');
    Route::get('/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/create', [CarController::class, 'store'])->name('cars.store');
    Route::get('/edit/{car}', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/edit/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/destroy/{car}', [CarController::class, 'destroy'])->name('cars.destroy');

});