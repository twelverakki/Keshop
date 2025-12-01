<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('products')->get();

        $query = Product::where('is_active', true)->with('category');

        $query->when($request->search, function ($q) use ($request) {return $q->where('name', 'like', '%' . $request->search . '%');});
        $query->when($request->categories, function ($q) use ($request) {return $q->whereIn('category_id', $request->categories);});
        $query->when($request->min_price, function ($q) use ($request) {return $q->where('price', '>=', $request->min_price);});
        $query->when($request->max_price, function ($q) use ($request) {return $q->where('price', '<=', $request->max_price);});

        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            default:
                $query->inRandomOrder();
                break;
        }

        $products = $query->paginate(9)->withQueryString();

        $recommendations = Product::with(['category'])
            ->withAvg('reviews', 'rating')
            ->whereHas('reviews')
            ->withCount('reviews')
            ->orderByDesc('reviews_avg_rating')
            ->limit(10)
            ->get();

            return view('shop.index', compact('categories', 'products', 'recommendations'));
    }

   public function show(Product $product)
    {
        $product->load(['reviews.user', 'category']);

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->with(['category'])
            ->withAvg('reviews', 'rating')
            ->whereHas('reviews')
            ->withCount('reviews')
            ->take(4)
            ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }
}