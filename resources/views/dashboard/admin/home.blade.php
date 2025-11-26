<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
            <div class="space-x-4">
                <a href="{{ route('admin.users') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700">Manage Users</a>
                <a href="{{ route('admin.categories') }}" class="bg-green-600 text-white px-4 py-2 rounded-md text-sm hover:bg-green-700">Manage Categories</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Total Revenue</p>
                    <p class="text-2xl font-bold text-hiyoucan-700">Rp {{ number_format($stats['total_sales'], 0, ',', '.') }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Total Orders</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_orders'] }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Registered Buyers</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 {{ $stats['pending_sellers'] > 0 ? 'border-red-500' : 'border-green-500' }}">
                    <p class="text-sm text-gray-500">Pending Sellers</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['pending_sellers'] }}</p>
                    @if($stats['pending_sellers'] > 0)
                        <a href="{{ route('admin.users') }}" class="text-xs text-red-500 hover:underline">Review Now</a>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-bold text-lg mb-4">Welcome, Admin!</h3>
                    <p>Anda memiliki akses penuh untuk mengelola pengguna, kategori, dan memantau transaksi platform Hiyoucan.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>