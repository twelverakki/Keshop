<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_sales' => Order::where('status', 'completed')->sum('total_price'),
            'total_orders' => Order::count(),
            'total_users' => User::where('role', 'user')->count(),
            'pending_sellers' => User::where('role', 'seller')->whereNull('email_verified_at')->count(),
        ];

        return view('dashboard.admin.home', compact('stats'));
    }

    public function users()
    {
        $users = User::where('role', '!=', 'admin')->latest()->get();
        return view('dashboard.admin.users', compact('users'));
    }

    public function verifySeller(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->role !== 'seller') {
            return back()->with('error', 'User ini bukan seller.');
        }

        if ($request->action === 'approve') {
            $user->email_verified_at = now();
            $user->save();
            return back()->with('success', 'Seller berhasil disetujui (Approved).');
        }

        if ($request->action === 'reject') {
            $user->email_verified_at = null;
            $user->save();
            return back()->with('success', 'Seller ditolak (Rejected) dan dikembalikan ke status pending.');
        }

        return back();
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:user,seller,admin'
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;

        if ($request->role === 'seller' && !$user->email_verified_at) {
            $user->email_verified_at = null;
        } elseif ($request->role === 'user') {
            $user->email_verified_at = now();
        }

        $user->save();

        return back()->with('success', 'Role pengguna berhasil diubah menjadi ' . ucfirst($request->role));
    }

    public function destroyUser($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }

    public function categories()
    {
        $categories = Category::withCount('products')->get();
        return view('dashboard.admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:categories,name']);
        Category::create(['name' => $request->name, 'slug' => Str::slug($request->name)]);
        return back()->with('success', 'Kategori ditambahkan.');
    }

    public function destroyCategory(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Kategori dihapus.');
    }
}