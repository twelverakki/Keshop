<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::where('seller_id', Auth::id())->latest()->paginate(10);
        return view('dashboard.seller.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.seller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'image_url' => 'required|url',
        ]);

        Product::create([
            'seller_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $request->image_url,
            'is_active' => true,
        ]);

        return redirect()->route('seller.products.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        if ($product->seller_id !== Auth::id()) {
            abort(403);
        }
        $categories = Category::all();
        return view('dashboard.seller.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->seller_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image_url' => 'required|url',
        ]);

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $request->image_url,
        ]);

        return redirect()->route('seller.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->seller_id !== Auth::id()) {
            abort(403);
        }

        $product->delete();
        return back()->with('success', 'Product deleted successfully!');
    }
}