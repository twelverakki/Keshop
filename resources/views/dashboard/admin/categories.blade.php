<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex gap-8">

            @php
                $isEditing = isset($category);
                $formAction = $isEditing ? route('admin.categories.update', $category->id) : route('admin.categories.store');
            @endphp

            <div class="w-1/3">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-lg mb-4">
                        {{ $isEditing ? 'Edit Category: ' . $category->name : 'Add New Category' }}
                    </h3>

                    <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if($isEditing)
                            @method('PUT')
                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                        @endif

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                            <input type="text" id="name" name="name"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#456845] focus:border-[#456845]"
                                required
                                placeholder="e.g. Serums"
                                value="{{ old('name', $isEditing ? $category->name : '') }}"
                            >
                            @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror

                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Category Icon/Image
                            @if($isEditing && $category->image)
                                </label>
                                <p class="mt-2 text-xs text-gray-500">Current Image:</p>
                                <img src="{{ asset('storage/' . $category->image) }}" alt="Current Category Image" class="w-16 h-16 object-cover rounded mt-1">
                            @else
                                : <span class="font-thin inline">belum ada gambar</span>
                                </label>
                            @endif

                            <input type="file" id="image" name="image"
                                class="mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                                accept="image/*">

                            @error('image')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror


                        </div>

                        <button type="submit" class="w-full bg-[#456845] text-white py-2 rounded-md hover:bg-hiyoucan-800 transition">
                            {{ $isEditing ? 'Save Changes' : 'Save Category' }}
                        </button>

                        @if($isEditing)
                            <a href="{{ route('admin.categories') }}" class="mt-3 block text-center text-sm text-gray-500 hover:text-gray-700">
                                Cancel / Add New
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <div class="w-2/3 bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="p-4 text-sm font-bold text-gray-600 w-12 text-center">No</th>
                            <th class="p-4 text-sm font-bold text-gray-600 w-16">Image</th>
                            <th class="p-4 text-sm font-bold text-gray-600">Name</th>
                            <th class="p-4 text-sm font-bold text-gray-600">Slug</th>
                            <th class="p-4 text-sm font-bold text-gray-600">Products Count</th>
                            <th class="p-4 text-right text-sm font-bold text-gray-600">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $cat)
                        <tr class="border-b last:border-0 hover:bg-gray-50">
                            <td class="p-4 text-sm text-gray-500 font-medium  text-center">{{ $loop->iteration }}</td>
                            <td class="p-4"><img src="{{ $cat->image_url }}" class="w-12 h-12 object-cover rounded border border-gray-200" alt="{{ $cat->name }}"></td>
                            <td class="p-4 font-bold text-gray-900">{{ $cat->name }}</td>
                            <td class="p-4 text-gray-500 italic text-sm">{{ $cat->slug }}</td>
                            <td class="p-4"><span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs font-semibold">{{ $cat->products_count }} Products</span></td>
                            <td class="p-4 text-right">
                                {{-- Container Alpine.js untuk mengelola dropdown --}}
                                <div x-data="{ open: false }" @click.outside="open = false" class="relative inline-block text-left">

                                    {{-- Tombol Ikon Tiga Titik --}}
                                    <button
                                        @click="open = ! open"
                                        type="button"
                                        class="text-gray-500 hover:text-gray-700 p-1.5 rounded-full hover:bg-gray-100 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300"
                                        title="More Actions"
                                        aria-expanded="true"
                                        aria-haspopup="true"
                                    >
                                        {{-- Ikon Tiga Titik Vertikal --}}
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                                    </button>

                                    {{-- Dropdown Menu --}}
                                    <div
                                        x-show="open"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95"
                                        class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-20"
                                        role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                        style="display: none;"
                                    >
                                        {{-- Bagian 1: Edit Kategori --}}
                                        <div class="py-1" role="none">
                                            <a href="{{ route('admin.categories.edit', $cat->id) }}"
                                                class="text-gray-700 hover:bg-gray-100 hover:text-gray-900 px-4 py-2 text-sm flex items-center gap-2"
                                                role="menuitem"
                                                title="Edit Nama atau Gambar Kategori"
                                            >
                                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                Edit Kategori
                                            </a>
                                        </div>

                                        {{-- Bagian 2: Hapus Kategori --}}
                                        <div class="py-1" role="none">
                                            <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" role="none" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $cat->name }}? Semua produk dalam kategori ini harus dipindahkan terlebih dahulu.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:bg-red-50 hover:text-red-800 w-full text-left px-4 py-2 text-sm flex items-center gap-2"
                                                    role="menuitem"
                                                    title="Hapus Kategori Permanen"
                                                >
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    Hapus Kategori
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
            </div>

        </div>
    </div>
</x-app-layout>