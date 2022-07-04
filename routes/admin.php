<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('layout_backend.master');
})->name('welcome');
Route::group([
    'as'     => 'users.',
    'prefix' => 'users',
],function(){
    Route::get('/',[UserController::class,'index'])->name('index');
    Route::get('/{user}', [UserController::class, 'show'])->name('show');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    Route::get('/update/status/identity', [UserController::class, 'updateStatusIdentity'])->name('update.status.identity');
    Route::get('/update/status/licenseCar', [UserController::class, 'updateStatusLicenseCar'])->name('update.status.licenseCar');
});
