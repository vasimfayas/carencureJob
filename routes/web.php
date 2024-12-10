<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;

// Dashboard Route
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Job Routes (resource will handle all CRUD routes)
Route::resource('Job', JobController::class); 