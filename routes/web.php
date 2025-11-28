<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', function() {
    $products = collect([
        // 12 item produk dummy...
        (object)['name' => 'Sofa Modular', 'price' => 120.00, 'discounted_price' => 100.00, 'slug' => 'sofa-modular', 'image_url' => 'sofa-modular.jpg'],
        (object)['name' => 'Meja Kopi Bundar', 'price' => 50.00, 'discounted_price' => null, 'slug' => 'meja-kopi-bundar', 'image_url' => 'meja-kopi.jpg'],
        (object)['name' => 'Lampu Lantai Nordik', 'price' => 75.00, 'discounted_price' => 60.00, 'slug' => 'lampu-nordik', 'image_url' => 'lampu-lantai.jpg'],
        (object)['name' => 'Rak Buku Minimalis', 'price' => 90.00, 'discounted_price' => null, 'slug' => 'rak-buku', 'image_url' => 'rak-buku.jpg'],
        (object)['name' => 'Kursi Makan Kayu', 'price' => 45.00, 'discounted_price' => 40.00, 'slug' => 'kursi-makan', 'image_url' => 'kursi-makan.jpg'],
        (object)['name' => 'Karpet Geometris', 'price' => 35.00, 'discounted_price' => null, 'slug' => 'karpet-geometris', 'image_url' => 'karpet.jpg'],
        (object)['name' => 'Bantal Dekorasi', 'price' => 15.00, 'discounted_price' => null, 'slug' => 'bantal-dekorasi', 'image_url' => 'bantal.jpg'],
        (object)['name' => 'Cermin Dinding', 'price' => 65.00, 'discounted_price' => 55.00, 'slug' => 'cermin-dinding', 'image_url' => 'cermin.jpg'],
        (object)['name' => 'Kabinet Penyimpanan', 'price' => 150.00, 'discounted_price' => null, 'slug' => 'kabinet-penyimpanan', 'image_url' => 'kabinet.jpg'],
        (object)['name' => 'Sofa Bed Lipat', 'price' => 200.00, 'discounted_price' => 180.00, 'slug' => 'sofa-bed', 'image_url' => 'sofa-bed.jpg'],
        (object)['name' => 'Pot Tanaman Besar', 'price' => 25.00, 'discounted_price' => null, 'slug' => 'pot-tanaman', 'image_url' => 'pot-tanaman.jpg'],
        (object)['name' => 'Jam Dinding Modern', 'price' => 30.00, 'discounted_price' => null, 'slug' => 'jam-dinding', 'image_url' => 'jam-dinding.jpg'],
    ]);
    return view('products.index', compact('products'));
})->name('shop');

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
