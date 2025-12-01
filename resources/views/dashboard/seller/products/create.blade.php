<x-app-layout>
    <div class="py-10 bg-gray-50">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-2xl rounded-xl p-8 border border-gray-100">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Create New Product</h3>

            <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6">

                    <div class="space-y-6">

                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Product Name</label>
                            <input type="text" id="name" name="name"
                                value="{{ old('name') }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#456845] focus:border-[#456845] transition duration-150" required>
                            @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-semibold text-gray-700 mb-1">Category</label>
                            <select id="category" name="category_id"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#456845] focus:border-[#456845] transition duration-150">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="price" class="block text-sm font-semibold text-gray-700 mb-1">Price (Rp)</label>
                                <input type="number" id="price" name="price"
                                    value="{{ old('price') }}"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#456845] focus:border-[#456845] transition duration-150" required>
                                @error('price')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="stock" class="block text-sm font-semibold text-gray-700 mb-1">Stock</label>
                                <input type="number" id="stock" name="stock"
                                    value="{{ old('stock') }}"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#456845] focus:border-[#456845] transition duration-150" required>
                                @error('stock')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">

                        <div>
                            <label for="image" class="block text-sm font-semibold text-gray-700 mb-1">Product Image</label>
                            <div class="flex flex-col items-center justify-center p-6 border-2 border-gray-200 border-dashed rounded-lg bg-gray-50 h-48">
                                <p class="text-sm text-gray-500 mb-3">Drag and drop or choose file below</p>
                                <input type="file" id="image" name="image" required
                                    class="w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-lg file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-gray-100 file:text-[#456845]
                                        hover:file:bg-gray-200 transition duration-150">
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG. Max size: 2MB.</p>
                            @error('image')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                            <textarea id="description" name="description" rows="7"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#456845] focus:border-[#456845] transition duration-150" required>{{ old('description') }}</textarea>
                            @error('description')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <button type="submit" class="w-full bg-[#456845] text-white py-3 rounded-lg font-bold hover:bg-green-700 transition shadow-md text-lg">
                        Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>