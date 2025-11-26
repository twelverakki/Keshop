<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- ADMIN ROUTES ---
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('home');

        // Manage Users
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::post('/users/{id}/verify', [AdminController::class, 'verifySeller'])->name('users.verify');
        Route::patch('/users/{id}/role', [AdminController::class, 'updateRole'])->name('users.update-role'); // BARU: Ubah Role
        Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');

        // Manage Categories
        Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
        Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
        Route::delete('/categories/{category}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');
    });

});

require __DIR__.'/auth.php';
