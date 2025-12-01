<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Supervision') }}
        </h2>
    </x-slot>

    <div class="pb-12 pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-6 border border-green-200">{{ session('success') }}</div>
            @endif

            <div class="relative pb-6 hidden lg:block">
                <form action="{{ route('admin.products') }}" method="GET" class="flex justify-end">

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="border-gray-300 focus:border-orange-500 focus:ring-orange-500 ml-auto w-full lg:w-1/3 rounded-full text-sm py-2 pl-4 pr-10" />
                    <button class="absolute right-0 top-0 mt-2 mr-2 text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-800 text-white border-b border-red-100">
                                <tr>
                                    <th class="p-4 pl-8">Image</th>
                                    <th class="p-4">Product Name</th>
                                    <th class="p-4">Price</th>
                                    <th class="p-4">Seller (Store)</th>
                                    <th class="p-4">Category</th>
                                    <th class="p-4 pr-8 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-4 pl-8">
                                        <img src="{{ $product->image_url }}" class="w-12 h-12 object-cover rounded border border-gray-200">
                                    </td>
                                    <td class="p-4">
                                        <span class="font-bold block text-gray-900">{{ $product->name }}</span>
                                        <span class="text-xs text-gray-500">ID: {{ $product->id }}</span>
                                    </td>
                                    <td class="p-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="p-4">
                                        <span class="font-medium text-purple-700">{{ $product->seller->name }}</span>
                                        @if($product->seller->store)
                                            <br><span class="text-xs text-gray-500">({{ $product->seller->store->name }})</span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        <span class="bg-gray-100 px-2 py-1 rounded text-xs">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                    </td>
                                    <td class="p-4 pr-8 text-right">
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

                    <div class="mt-4 px-8 pb-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>