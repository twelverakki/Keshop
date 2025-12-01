<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_sales' => Order::where('status', 'completed')->sum('total_price'),
            'total_orders' => Order::count(),
            'total_users' => User::whereNot('role', 'admin')->count(),
            'pending_sellers' => User::where('role', 'seller')->whereNull('email_verified_at')->count(),
        ];

        return view('dashboard.admin.home', compact('stats'));
    }

    public function users(Request $request)
    {
        $query = User::where('role', '!=', 'admin');

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->role && $request->role != 'all') {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(10)->withQueryString();
        return view('dashboard.admin.users', compact('users'));
    }

    public function products(Request $request)
    {
        $query = Product::with(['seller', 'category']);

        if ($request->search) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        return view('dashboard.admin.products', compact('products'));
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
            return back()->with('success', 'Seller ditolak (Rejected).');
        }

        return back();
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:user,seller'
        ]);

        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return back()->with('error', 'Tidak dapat mengubah role sesama Admin.');
        }

        $user->role = $request->role;

        if ($request->role === 'seller' && !$user->email_verified_at) {
            $user->email_verified_at = null;
        } elseif ($request->role === 'user') {
            $user->email_verified_at = now();
        }

        $user->save();

        return back()->with('success', 'Role pengguna berhasil diubah menjadi ' . ucfirst($request->role));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.admin.users-edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return back()->with('error', 'Tidak dapat mengubah role Admin.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|min:8',
            'role' => 'required|in:buyer,seller'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;


        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->role === 'seller' && !$user->email_verified_at) {
            $user->email_verified_at = null;
        } elseif ($request->role === 'user') {
            $user->email_verified_at = now();
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'Informasi pengguna berhasil diperbarui.');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->role === 'admin') {
            return back()->with('error', 'Tidak bisa menghapus Admin.');
        }
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }

    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && !Str::startsWith($product->getRawOriginal('image'), 'http')) {
            Storage::disk('public')->delete($product->getRawOriginal('image'));
        }

        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus karena melanggar ketentuan.');
    }

    public function categories()
    {
        $categories = Category::withCount('products')->get();

        return view('dashboard.admin.categories', compact('categories'));
    }

    public function editCategory(Category $category)
    {
        $categories = Category::withCount('products')->get();

        return view('dashboard.admin.categories', compact('categories', 'category'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $imagePath
        ]);

        return back()->with('success', 'Kategori ditambahkan.');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ];

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);
        return redirect()->route('admin.categories')->with('success', 'Kategori "' . $category->name . '" berhasil diperbarui.');
    }

    public function destroyCategory(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Kategori dihapus.');
    }
}