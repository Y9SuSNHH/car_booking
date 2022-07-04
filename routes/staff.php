<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('layout_backend.sidebar');
})->name('welcome');
