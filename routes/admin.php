<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('layout_backend.master');
})->name('welcome');
<<<<<<< Updated upstream
Route::group(['middleware' => ['web']], function () {

Route::group(['as'=> 'users.', 'prefix' => 'users',],function(){
    Route::get('/',[UserController::class,'index'])->name('index');
=======
Route::group([
    'as'     => 'users.',
    'prefix' => 'users',
], function() {
    Route::get('/', [UserController::class, 'index'])->name('index');
>>>>>>> Stashed changes
    Route::get('/{user}', [UserController::class, 'show'])->name('show');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/create', [UserController::class, 'store'])->name('store');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});

Route::group([
    'prefix' => 'cars',
], function() {
    Route::get('/', [CarController::class, 'index'])->name('cars.index');
    Route::get('/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/create', [CarController::class, 'store'])->name('cars.store');
    Route::get('/edit/{cars}', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/edit/{cars}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/destroy/{cars}', [CarController::class, 'destroy'])->name('cars.destroy');
});
<<<<<<< Updated upstream

});
=======
Route::group(['middleware' => ['web']], function () {});
>>>>>>> Stashed changes
