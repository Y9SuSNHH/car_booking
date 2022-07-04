<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
Route::get('/', function() {
    return view('layout_backend.master');
})->name('welcome');


Route::group(['prefix' => 'cars'], function(){
    Route::get('/', [CarController::class, 'index'])->name('cars.index');
    Route::get('/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/create', [CarController::class, 'store'])->name('cars.store');
    Route::get('/edit/{car}', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/edit/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/destroy/{car}', [CarController::class, 'destroy'])->name('cars.destroy');
});

Route::get('/signin', [AuthController::class, 'signin'])->name('signin');
Route::post('/signin', [AuthController::class, 'processSignIn'])->name('process.signin');
Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/signup', [AuthController::class, 'processSignUp'])->name('process.signup');
Route::get('/signout', [AuthController::class, 'signout'])->name('signout');
Route::get('/auth/redirect/{provider}', function($provider) {
    return Socialite::driver($provider)->redirect();
})->name('auth.redirect');
Route::get('/auth/callback/{provider}', [AuthController::class, 'callback'])->name('auth.callback');

