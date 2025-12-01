<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Product') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Product Name</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#76a576] focus:border-[#76a576]" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category_id" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#76a576] focus:border-[#76a576]">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Price (Rp)</label>
                                <input type="number" name="price" value="{{ old('price', $product->price) }}" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#76a576] focus:border-[#76a576]" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Stock</label>
                                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#76a576] focus:border-[#76a576]" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Change Product Image</label>

                            <div class="my-2">
                                <img src="{{ $product->image }}" alt="Current Image" class="h-32 w-32 object-cover rounded border border-gray-200">
                                <p class="text-xs text-gray-400 mt-1">Current Image</p>
                            </div>

                            <input type="file" name="image" class="mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-hiyoucan-50 file:text-[#456845] hover:file:bg-hiyoucan-100">
                            <p class="text-xs text-gray-500 mt-1">Upload new image to replace the old one (Max 2MB).</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" rows="4" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#76a576] focus:border-[#76a576]" required>{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('seller.products.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md font-medium hover:bg-gray-300">Cancel</a>
                            <button type="submit" class="bg-[#456845] text-white px-6 py-2 rounded-md font-bold hover:bg-hiyoucan-800">Update Product</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>