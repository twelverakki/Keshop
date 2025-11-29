<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Supervision') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-6 border border-green-200">{{ session('success') }}</div>
            @endif

            <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
                <form action="{{ route('admin.products') }}" method="GET" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product name..." class="w-full border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500">
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Search</button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4 text-sm text-gray-500">Sebagai Admin, Anda berhak menghapus produk yang melanggar Syarat & Ketentuan platform.</p>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-red-50 text-red-900 border-b border-red-100">
                                <tr>
                                    <th class="p-4">Image</th>
                                    <th class="p-4">Product Name</th>
                                    <th class="p-4">Seller (Store)</th>
                                    <th class="p-4">Price</th>
                                    <th class="p-4">Category</th>
                                    <th class="p-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-4">
                                        <img src="{{ $product->image }}" class="w-12 h-12 object-cover rounded border border-gray-200">
                                    </td>
                                    <td class="p-4">
                                        <span class="font-bold block text-gray-900">{{ $product->name }}</span>
                                        <span class="text-xs text-gray-500">ID: {{ $product->id }}</span>
                                    </td>
                                    <td class="p-4">
                                        <span class="font-medium text-purple-700">{{ $product->seller->name }}</span>
                                        @if($product->seller->store)
                                            <br><span class="text-xs text-gray-500">({{ $product->seller->store->name }})</span>
                                        @endif
                                    </td>
                                    <td class="p-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="p-4">
                                        <span class="bg-gray-100 px-2 py-1 rounded text-xs">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                    </td>
                                    <td class="p-4 text-right">
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('PERINGATAN: Anda akan menghapus produk milik Seller ini secara permanen. Lanjutkan?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-3 py-1.5 rounded text-xs hover:bg-red-700 flex items-center gap-1 ml-auto">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Force Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="p-4 text-center text-gray-500">No products found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>