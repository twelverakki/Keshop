<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('My Products') }}</h2>
            <a href="{{ route('seller.products.create') }}" class="bg-[#456845] text-white px-4 py-2 rounded-lg text-sm hover:bg-[#2f442f]">+ Add Product</a>
        </div>
    </x-slot>

    <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white shadow-2xl rounded-xl border border-gray-100">
            <div class="p-6">

                    <table class="w-full text-left text-sm divide-y divide-gray-200">
                        <thead class="bg-gray-50 uppercase text-xs text-gray-600 tracking-wider">
                            <tr>
                                <th class="p-4">Image</th>
                                <th class="p-4">Name</th>
                                <th class="p-4">Category</th>
                                <th class="p-4">Price</th>
                                <th class="p-4 text-center">Stock</th>
                                <th class="p-4 text-center">Status</th>
                                <th class="p-4 text-right">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @foreach($products as $product)
                            <tr class="hover:bg-gray-50 transition duration-100">

                                <td class="p-4">
                                    <img src="{{ $product->image_url }}"
                                         class="w-14 h-14 object-cover rounded-lg border border-gray-200 shadow-sm"
                                         alt="{{ $product->name }}">
                                </td>

                                <td class="p-4 font-bold text-gray-800 max-w-xs">{{ $product->short_name }}</td>

                                <td class="p-4 text-gray-600">{{ $product->category->name }}</td>

                                <td class="p-4 font-semibold text-gray-900 whitespace-nowrap">Rp {{ number_format($product->price, 0, ',', '.') }}</td>

                                <td class="p-4 text-center">
                                    @php
                                        $stockColor = $product->stock < 10 ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800';
                                    @endphp
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $stockColor }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>

                                <td class="p-4 text-center">
                                    @php
                                        $isActiveColor = $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-500';
                                    @endphp
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $isActiveColor }}">
                                        {{ $product->is_active ? 'Active' : 'Draft' }}
                                    </span>
                                </td>

                                <td class="p-4 text-right">
                                    <div x-data="{ open: false }" @click.outside="open = false" class="relative inline-block text-left">

                                        <button @click="open=!open" type="button" class="text-gray-500 hover:text-gray-700 p-1.5 rounded-full hover:bg-gray-100 transition focus:outline-none">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                                        </button>

                                        <div x-show="open"
                                             x-transition:enter="transition ease-out duration-100"
                                             x-transition:enter-start="transform opacity-0 scale-95"
                                             x-transition:enter-end="transform opacity-100 scale-100"
                                             class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 z-10"
                                             style="display: none;">

                                            <div class="py-1">
                                                <a href="{{ route('seller.products.edit', $product->id) }}" class="text-gray-700 hover:bg-gray-100 block px-4 py-2 text-sm flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                    Edit Product
                                                </a>
                                            </div>

                                            <div class="py-1">
                                                <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" class="block">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:bg-red-50 w-full text-left px-4 py-2 text-sm flex items-center gap-2">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                <div class="mt-4 flex justify-between items-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>