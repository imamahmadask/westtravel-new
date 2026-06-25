<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TravelPackageController;

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::get('/packages', [TravelPackageController::class, 'index'])->name('packages.index');

Route::get('/packages/{slug}', [TravelPackageController::class, 'show'])->name('packages.show');
