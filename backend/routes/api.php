<?php

use App\Http\Controllers\Test1Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GetUserEmailController;
use App\Http\Controllers\GetUserPhoneController;
use Illuminate\Support\Facades\Route;

Route::resource('/users', UserController::class);
Route::get('/emails', GetUserEmailController::class);
Route::get('/phones', GetUserPhoneController::class);

Route::get('test-1', Test1Controller::class)->name('test-1');
