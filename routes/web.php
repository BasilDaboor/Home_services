<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicesController;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::prefix('dashboard')->name('dashboard.')->middleware(['auth', 'role:admin,super_admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('home');

    //service routes
    // Route::resource('/services', ServicesController::class)->name('index', 'services.index')->name('create', 'services.create')->name('edit', 'services.edit')->name('show', 'services.show')->name('destroy', 'services.destroy');
    Route::get('/services', [ServicesController::class, 'index'])->name('services.index');
    Route::get('/services/create', [ServicesController::class, 'create'])->name('services.create');
    Route::post('/services', [ServicesController::class, 'store'])->name('services.store');
    Route::get('services/{service}/edit', [ServicesController::class, 'edit'])->name('services.edit');
    Route::get('/services/{service}', [ServicesController::class, 'show'])->name('services.show');
    Route::put('/services/{service}', [ServicesController::class, 'update'])->name('services.update');
    Route::delete('services/{id}', [ServicesController::class, 'destroy'])->name('services.destroy');

    //booking routes
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});
require __DIR__ . '/auth.php';
