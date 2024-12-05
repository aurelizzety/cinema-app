<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('movies', MovieController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('seats', SeatController::class);
    Route::resource('transactions', TransactionController::class);
});
