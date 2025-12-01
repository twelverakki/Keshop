<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoresController extends Controller
{

    public function edit()
    {
        $store = Store::where('user_id', Auth::id())->first();
        return view('dashboard.seller.store.edit', compact('store'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();

        $store = Store::firstOrNew(['user_id' => $user->id]);

        $store->name = $request->name;
        if ($store->name !== $request->name) {
             $store->slug = Str::slug($request->name) . '-' . Str::random(5);
        }
        if (!$store->slug) {
             $store->slug = Str::slug($request->name) . '-' . Str::random(5);
        }
        $store->description = $request->description;

        if ($request->hasFile('logo')) {
            if ($store->logo) {
                Storage::disk('public')->delete($store->logo);
            }
            $path = $request->file('logo')->store('stores', 'public');
            $store->logo = $path;
        }

        $store->save();

        return back()->with('success', 'Informasi toko berhasil diperbarui!');
    }


    public function index()
    {
        $sellerId = Auth::id();

        $stats = [
            'total_products' => Product::where('seller_id', $sellerId)->count(),

            'items_sold' => OrderItem::whereHas('product', function($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })
            ->whereHas('order', function($q) {
                $q->whereIn('status', ['processing', 'completed']);
            })
            ->sum('quantity'),

            'revenue' => OrderItem::whereHas('product', function($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })
            ->whereHas('order', function($q) {
                $q->whereIn('status', ['processing', 'completed']);
            })
            ->sum(DB::raw('price * quantity')),
        ];
        $recentOrders = OrderItem::whereHas('product', function($q) use ($sellerId) {
            $q->where('seller_id', $sellerId);
        })->with(['order.user', 'product'])->latest()->take(5)->get();

        return view('dashboard.seller.home', compact('stats', 'recentOrders'));
    }

    public function orders()
    {
        $sellerId = Auth::id();
        $orderItems = OrderItem::whereHas('product', function($q) use ($sellerId) {
            $q->where('seller_id', $sellerId);
        })->with(['order.user', 'product'])->latest()->paginate(10);

        return view('dashboard.seller.orders', compact('orderItems'));
    }

    public function updateOrderStatus(Request $request, $orderId)
    {
        $request->validate(['status' => 'required|in:pending,processing,completed,cancelled']);
        $order = Order::findOrFail($orderId);
        $order->status = $request->status;
        $order->save();
        return back()->with('success', 'Order status updated.');
    }
}