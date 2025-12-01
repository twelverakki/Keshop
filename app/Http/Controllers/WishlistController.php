<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $wishlists = $user->wishlists()->with('product.category')->latest()->paginate(10);
        
        return view('wishlist.index', compact('wishlists'));
    }

    public function toggle(Product $product)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $exists = Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($exists) {
            $exists->delete();
            $message = 'Product removed from wishlist.';
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $product->id
            ]);
            $message = 'Product added to wishlist!';
        }

        return back()->with('success', $message);
    }
}