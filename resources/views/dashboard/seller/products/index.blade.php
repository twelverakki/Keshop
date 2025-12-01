<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('My Products') }}</h2>
            <a href="{{ route('seller.products.create') }}" class="bg-[#456845] text-white px-4 py-2 rounded text-sm hover:bg-hiyoucan-800">+ Add Product</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="p-4">Image</th>
                                <th class="p-4">Name</th>
                                <th class="p-4">Category</th>
                                <th class="p-4">Price</th>
                                <th class="p-4">Stock</th>
                                <th class="p-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4">
                                    <img src="{{ Storage::url($product->image) }}" class="w-12 h-12 object-cover rounded">
                                </td>
                                <td class="p-4 font-bold">{{ $product->name }}</td>
                                <td class="p-4">{{ $product->category->name }}</td>
                                <td class="p-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="p-4">{{ $product->stock }}</td>
                                <td class="p-4 text-right space-x-2">
                                    <a href="{{ route('seller.products.edit', $product->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this product?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $products->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>