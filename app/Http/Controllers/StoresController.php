<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoresController extends Controller
{
    public function index()
    {
        $sellerId = Auth::id();

        $stats = [
            'total_products' => Product::where('seller_id', $sellerId)->count(),

            'items_sold' => OrderItem::whereHas('product', function($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })->sum('quantity'),

            'revenue' => OrderItem::whereHas('product', function($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })->sum(DB::raw('price * quantity')),
        ];

        $recentOrders = OrderItem::whereHas('product', function($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })
            ->with(['order.user', 'product'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.seller.home', compact('stats', 'recentOrders'));
    }

    public function orders()
    {
        $sellerId = Auth::id();

        $orderItems = OrderItem::whereHas('product', function($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })
            ->with(['order.user', 'product'])
            ->latest()
            ->paginate(10);

        return view('dashboard.seller.orders', compact('orderItems'));
    }

    public function updateOrderStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order = Order::findOrFail($orderId);

        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Order status updated to ' . ucfirst($request->status));
    }
}