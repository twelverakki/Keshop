@php
    $isEditing = isset($category);
    $formAction = $isEditing ? route('admin.categories.update', $category->id) : route('admin.categories.store');
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Category Management') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 font-medium border border-green-200 shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex gap-8">

                <div class="w-full lg:w-1/3 flex-shrink-0">
                    <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-100 sticky top-10">
                        <h3 class="font-bold text-xl mb-4 border-b pb-3 text-gray-800">
                            {{ $isEditing ? 'Edit Category: ' . $category->name : 'Add New Category' }}
                        </h3>

                        <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if($isEditing)
                                @method('PUT')
                            @endif

                            <div class="mb-4">
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Category Name</label>
                                <input type="text" id="name" name="name"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#456845] focus:border-[#456845] transition duration-150"
                                    required
                                    placeholder="e.g. Serums"
                                    value="{{ old('name', $isEditing ? $category->name : '') }}"
                                >
                                @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div class="mb-4">
                                <label for="image" class="block text-sm font-semibold text-gray-700 mb-1">Category Icon/Image</label>

                                @if($isEditing && $category->image)
                                    <div class="mt-2 mb-3">
                                        <img src="{{ $category->image_url }}" alt="Current Category Image" class="w-16 h-16 object-cover rounded-lg border-2 border-gray-200 shadow-sm">
                                    </div>
                                @endif

                                <input type="file" id="image" name="image"
                                    class="w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-lg file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-gray-100 file:text-[#456845]
                                        hover:file:bg-gray-200 transition duration-150"
                                    accept="image/*">
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $isEditing ? 'Upload baru untuk mengganti.' : 'Diperlukan untuk visual toko.' }}
                                </p>
                                @error('image')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                            </div>

                            <button type="submit" class="w-full bg-[#456845] text-white py-3 rounded-lg font-bold hover:bg-green-700 transition shadow-md text-lg">
                                {{ $isEditing ? 'Save Changes' : 'Save Category' }}
                            </button>

                            @if($isEditing)
                                <a href="{{ route('admin.categories') }}" class="mt-3 block text-center text-sm text-gray-500 hover:text-gray-700 font-medium">
                                    ← Cancel / Add New
                                </a>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="w-full lg:w-2/3 bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-100">
                    <div class="overflow-x-auto">
                         <table class="min-w-full text-left divide-y divide-gray-200">
                            <thead class="bg-gray-50 uppercase text-xs text-gray-600 tracking-wider">
                                <tr>
                                    <th class="p-4 w-12 text-center">No</th>
                                    <th class="p-4 w-16">Image</th>
                                    <th class="p-4">Name</th>
                                    <th class="p-4">Slug</th>
                                    <th class="p-4">Products Count</th>
                                    <th class="p-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($categories as $cat)
                                <tr class="hover:bg-gray-50 transition duration-100">
                                    <td class="p-4 text-sm text-gray-600 text-center font-medium">{{ $loop->iteration }}</td>

                                    <td class="p-4">
                                        <img src="{{ $cat->image_url }}" class="w-12 h-12 object-cover rounded-md border border-gray-200" alt="{{ $cat->name }}">
                                    </td>

                                    <td class="p-4 font-bold text-gray-900">{{ $cat->name }}</td>
                                    <td class="p-4 text-gray-500 italic text-sm">{{ $cat->slug }}</td>

                                    <td class="p-4">
                                        <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold border border-blue-100">
                                            {{ $cat->products_count }} Products
                                        </span>
                                    </td>

                                    <td class="p-4 text-right">
                                        <div x-data="{ open: false }" @click.outside="open = false" class="relative inline-block text-left">
                                            <button @click="open=! open" type="button" class="text-gray-500 hover:text-gray-700 p-1.5 rounded-full hover:bg-gray-100 transition focus:outline-none">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                                            </button>
                                            <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 z-20" style="display: none;">
                                                <div class="py-1">
                                                    <a href="{{ route('admin.categories.edit', $cat->id) }}" class="text-gray-700 hover:bg-gray-100 px-4 py-2 text-sm flex items-center gap-2"><svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg> Edit</a>
                                                </div>
                                                <div class="py-1">
                                                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $cat->name }}?')" class="block">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:bg-red-50 w-full text-left px-4 py-2 text-sm flex items-center gap-2">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> Delete
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
        </div>
    </div>
</x-app-layout>