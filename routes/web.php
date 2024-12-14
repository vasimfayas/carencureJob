<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PageController;

// Dashboard Route
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Job Routes (resource will handle all CRUD routes)
Route::resource('Job', JobController::class); 
Route::get('Addjob',[JobController::class,'addjob'])->name('addjob');
Route::get('view-pdf/{id}', [JobController::class, 'viewPdf'])->name('view.pdf');
Route::resource('home',PageController::class);