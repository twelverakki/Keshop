<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home() {
        $categories = Category::withCount('products')->get();

        // $newProducts = Product::with(['category'])
        //                      ->latest()
        //                      ->limit(8)
        //                      ->get();

        // $topRatingProducts = Product::with(['category'])
        //                            ->orderByDesc('rating')
        //                            ->limit(4)
        //                            ->get();

        // $bestSellerProducts = Product::with(['category'])
        //                     ->withCount('orderItems')
        //                     ->orderByDesc('order_items_count')
        //                     ->limit(4)
        //                     ->get();
        $limit = 4;

        // 1. NEW PRODUCTS (Terbaru)
        $newProducts = Product::with(['category'])
                             ->withCount('reviews') // Tambahkan hitungan reviews
                             ->latest()
                             ->limit($limit)
                             ->get();

        // 2. TOP RATING (Diurutkan berdasarkan Rata-rata Rating Tertinggi)
        $topRatingProducts = Product::with(['category'])
                                   // Menghitung rata-rata rating (kolom baru: reviews_avg_rating)
                                   ->withAvg('reviews', 'rating')
                                   // Menghitung jumlah review (kolom baru: reviews_count)
                                   ->withCount('reviews')
                                   // Mengurutkan berdasarkan kolom hasil kalkulasi
                                   ->orderByDesc('reviews_avg_rating')
                                   ->limit($limit)
                                   ->get();

        // 3. BEST SELLERS (Diurutkan berdasarkan Jumlah Penjualan Tertinggi)
        // ASUMSI: Relasi orderItems() sudah ada di Product Model Anda
        $bestSellerProducts = Product::with(['category'])
                                    // Menghitung jumlah penjualan (kolom baru: order_items_count)
                                    ->withCount('orderItems')
                                    // Mengurutkan berdasarkan jumlah penjualan
                                    ->orderByDesc('order_items_count')
                                    ->limit($limit)
                                    ->get();

        return view('home', [
            'newProducts' => $newProducts->toJson(),
            'topRatingProducts' => $topRatingProducts->toJson(),
            'bestSellerProducts' => $bestSellerProducts->toJson(),
            'categories' => $categories
        ]);

    }

    public function index()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            if ($role == 'admin') {
                return redirect()->route('admin.home');
            }

            if ($role == 'seller') {
                return redirect()->route('seller.home');
            }

            return redirect()->route('shop.index');
        } else {
            return redirect('login');
        }
    }
}