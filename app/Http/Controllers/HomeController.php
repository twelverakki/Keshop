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

        $limit = 4;

        $newProducts = Product::with(['category'])
                             ->withCount('reviews')
                             ->latest()
                             ->limit($limit)
                             ->get();

        $topRatingProducts = Product::with(['category'])
                                   ->withAvg('reviews', 'rating')
                                   ->withCount('reviews')
                                   ->orderByDesc('reviews_avg_rating')
                                   ->limit($limit)
                                   ->get();

        $bestSellerProducts = Product::with(['category'])
                                    ->withCount('orderItems')
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