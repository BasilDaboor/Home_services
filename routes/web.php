<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ServicesPageController;
use App\Http\Controllers\UserController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/services/{service}', [HomeController::class, 'serviceProviders'])->name('service.providers');
Route::get('/providers/{provider}', [HomeController::class, 'providerDetails'])->name('provider.details');

Route::get('/services', [ServicesPageController::class, 'index'])->name('services.index');
Route::get('/services/category/{category}', [ServicesPageController::class, 'category'])->name('services.category');

Route::middleware('auth')->prefix('account')->name('account.')->group(function () {
    // Customer routes
    Route::middleware('role:customer')->group(function () {
        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
        Route::get('/bookings', [CustomerController::class, 'bookings'])->name('bookings');
        Route::post('/bookings', [BookingController::class, 'customerStore'])->name('bookings.store');
        Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    });

    // Provider routes
    Route::middleware('role:provider')->group(function () {
        Route::get('/provider/dashboard', [ProviderController::class, 'dashboard'])->name('provider.dashboard');
        Route::get('/provider/bookings', [ProviderController::class, 'bookings'])->name('provider.bookings');
        Route::patch('/provider/bookings/{booking}/status', [ProviderController::class, 'updateBookingStatus'])->name('provider.bookings.status');
        Route::get('/provider/profile', [ProviderController::class, 'editProfile'])->name('provider.profile.edit');
        Route::put('/provider/profile', [ProviderController::class, 'updateProfile'])->name('provider.profile.update');
    });
});




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

    //user routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{users}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
require __DIR__ . '/auth.php';
