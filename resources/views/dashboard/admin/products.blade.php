<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Product Supervision') }}
        </h2>
    </x-slot>

    <div class="pb-8 pt-6 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 font-medium border border-green-200 shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="pb-6">
                <form action="{{ route('admin.products') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products, sellers, or IDs..."
                           class="border-gray-300 focus:border-blue-600 focus:ring-blue-600 w-full rounded-xl text-lg py-3 pl-5 pr-12 shadow-inner transition" />
                    <button type="submit" class="absolute right-0 top-0 mt-3 mr-4 text-gray-500 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-2xl rounded-xl border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm divide-y divide-gray-200">
                        <thead class="bg-gray-800 text-white uppercase text-xs tracking-wider">
                            <tr>
                                <th class="p-4 pl-8">Image</th>
                                <th class="p-4">Product Info</th>
                                <th class="p-4">Price</th>
                                <th class="p-4">Seller / Store</th>
                                <th class="p-4 text-center">Status</th>
                                <th class="p-4 text-right pr-8">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($products as $product)
                            <tr class="hover:bg-red-50/50 transition duration-150">

                                <td class="p-4 pl-8">
                                    <img src="{{ $product->image_url }}" class="w-14 h-14 object-cover rounded-lg border border-gray-200 shadow-sm" alt="{{ $product->name }}">
                                </td>

                                <td class="p-4">
                                    <span class="font-bold block text-gray-900">{{ $product->name }}</span>
                                    <span class="text-xs text-gray-500">ID: {{ $product->id }}</span>
                                    <span class="text-xs text-purple-600 font-semibold block mt-1">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                </td>

                                <td class="p-4 font-semibold text-lg text-red-600 whitespace-nowrap">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>

                                <td class="p-4">
                                    <span class="font-medium text-purple-700 block">{{ $product->seller->name }}</span>
                                    @if($product->seller->store)
                                        <span class="text-xs text-gray-500 font-semibold">({{ $product->seller->store->name }})</span>
                                    @endif
                                </td>

                                <td class="p-4 text-center">
                                    @php
                                        $isActiveColor = $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                                    @endphp
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $isActiveColor }}">
                                        {{ $product->is_active ? 'ACTIVE' : 'INACTIVE' }}
                                    </span>
                                </td>

                                <td class="p-4 pr-8 text-right">
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('⚠️ PERINGATAN KERAS: Anda akan menghapus produk secara permanen. Lanjutkan?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-red-800 flex items-center gap-1 ml-auto shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            FORCE DELETE
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-gray-500 font-medium bg-gray-50 rounded-b-xl">
                                    No products found matching the criteria.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 px-8 py-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>