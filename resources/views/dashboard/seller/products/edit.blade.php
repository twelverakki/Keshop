<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">{{ __('Edit Product') }}</h2>
</x-slot>

<div class="py-10 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-2xl rounded-xl p-8 border border-gray-100">

            <h3 class="text-2xl font-extrabold text-gray-900 mb-8 border-b pb-4">
                Update Details for Product
            </h3>

            <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-2 space-y-6">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Product Name</label>
                                <input type="text" id="name" name="name"
                                    value="{{ old('name', $product->name) }}"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#456845] focus:border-[#456845] transition duration-150" required>
                            </div>

                            <div>
                                <label for="category" class="block text-sm font-semibold text-gray-700 mb-1">Category</label>
                                <select id="category" name="category_id"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#456845] focus:border-[#456845] transition duration-150">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-semibold text-gray-700 mb-1">Price (Rp)</label>
                                <input type="number" id="price" name="price"
                                    value="{{ old('price', $product->price) }}"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#456845] focus:border-[#456845] transition duration-150" required>
                            </div>

                            <div>
                                <label for="stock" class="block text-sm font-semibold text-gray-700 mb-1">Stock</label>
                                <input type="number" id="stock" name="stock"
                                    value="{{ old('stock', $product->stock) }}"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#456845] focus:border-[#456845] transition duration-150" required>
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                            <textarea id="description" name="description" rows="10"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#456845] focus:border-[#456845] transition duration-150" required>{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>

                    <div class="lg:col-span-1 border-l lg:border-gray-100 lg:pl-6 space-y-4">
                        <label class="block text-base font-bold text-gray-800">Product Visual</label>

                        <div class="aspect-square w-full bg-gray-50 rounded-xl overflow-hidden shadow-inner flex items-center justify-center border-4 border-dashed border-gray-200">
                             <img
                                src="{{ $product->image_url }}"
                                alt="Current Image"
                                class="w-full h-full object-contain p-4"
                            >
                        </div>

                        <label class="block text-sm font-semibold text-gray-700 mt-4">Change Image File</label>
                        <input type="file" name="image"
                            class="w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-lg file:border-0
                                file:text-sm file:font-semibold
                                file:bg-[#456845] file:text-white
                                hover:file:bg-gray-700 transition duration-150">
                        <p class="text-xs text-gray-500 mt-1">
                            Format: JPG, PNG. Max 2MB. File baru akan menggantikan gambar ini.
                        </p>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-10 pt-4 border-t border-gray-100">
                    <a href="{{ route('seller.products.index') }}" class="bg-gray-100 text-gray-700 px-5 py-2 rounded-lg font-medium hover:bg-gray-200 transition">Cancel</a>
                    <button type="submit" class="bg-[#456845] text-white px-5 py-2 rounded-lg font-bold hover:bg-green-700 transition shadow-md">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

</x-app-layout>