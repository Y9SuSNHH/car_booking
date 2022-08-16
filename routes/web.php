<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
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

Route::get('/test', function (){
    return view('test');
})->name('test');

Route::get('/', [AuthController::class, 'index'])->name('index');
Route::post('/test-func', [TestController::class, 'testFunc'])->name('test.func');
Route::get('/signin', [AuthController::class, 'signin'])->name('signin');
Route::post('/signin', [AuthController::class, 'processSignIn'])->name('process_signin');
Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/signup', [AuthController::class, 'processSignUp'])->name('process_signup');
Route::get('/signout', [AuthController::class, 'signout'])->name('signout');
Route::get('/auth/redirect/{provider}', function($provider) {
    return Socialite::driver($provider)->redirect();
})->name('auth.redirect');
Route::get('/auth/callback/{provider}', [AuthController::class, 'callback'])->name('auth.callback');

