<x-app-layout>
    <div class="py-10 bg-gray-50">
    {{-- Container Diperluas ke Max-w-5xl --}}
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

        {{-- Container Form Baru --}}
        <div class="bg-white overflow-hidden shadow-2xl rounded-xl p-8 border border-gray-100">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Create New Product</h3>

            <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6">

                    {{-- KOLOM KIRI (Name, Category, Price, Stock) --}}
                    <div class="space-y-6">

                        {{-- Product Name --}}
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Product Name</label>
                            <input type="text" id="name" name="name"
                                value="{{ old('name') }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#456845] focus:border-[#456845] transition duration-150" required>
                            @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Category --}}
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

                        {{-- Price & Stock --}}
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

                    {{-- KOLOM KANAN (Image dan Description) --}}
                    <div class="space-y-6">

                        {{-- Product Image Upload --}}
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

                        {{-- Description --}}
                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                            <textarea id="description" name="description" rows="7"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#456845] focus:border-[#456845] transition duration-150" required>{{ old('description') }}</textarea>
                            @error('description')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi (Full Width Footer) --}}
                <div class="mt-8 pt-6 border-t border-gray-100">
                    <button type="submit" class="w-full bg-[#456845] text-white py-3 rounded-lg font-bold hover:bg-green-700 transition shadow-md text-lg">
                        Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

    {{-- <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Product Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-900 focus:border-green-900" required>
                            @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category_id" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-900 focus:border-green-900">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Price (Rp)</label>
                                <input type="number" name="price" value="{{ old('price') }}" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-900 focus:border-green-900" required>
                                @error('price')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Stock</label>
                                <input type="number" name="stock" value="{{ old('stock') }}" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-900 focus:border-green-900" required>
                                @error('stock')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Product Image</label>
                            <input type="file" name="image" class="mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" required>
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Max size: 2MB.</p>
                            @error('image')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" rows="4" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-900 focus:border-green-900" required>{{ old('description') }}</textarea>
                            @error('description')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <button type="submit" class="w-full bg-green-700 text-white py-3 rounded-md font-bold hover:bg-green-800">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
</x-app-layout>