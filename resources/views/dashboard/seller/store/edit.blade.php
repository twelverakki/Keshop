<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Store Profile') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-2xl rounded-xl p-8 border border-gray-100">

            <h3 class="text-2xl font-bold text-gray-900 mb-6 border-b pb-4">
                Store Settings & Branding
            </h3>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 font-medium border border-green-200 shadow-sm">{{ session('success') }}</div>
            @endif

            <form action="{{ route('seller.store.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6">

                    <div class="space-y-6">

                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Store Name</label>
                            <input type="text" id="name" name="name"
                                value="{{ old('name', $store->name ?? Auth::user()->name . "'s Store") }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#456845] focus:border-[#456845] transition duration-150" required>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                            <textarea id="description" name="description" rows="7"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-[#456845] focus:border-[#456845] transition duration-150">{{ old('description', $store->description ?? '') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Ceritakan sedikit tentang toko Anda.</p>
                        </div>
                    </div>

                    <div class="space-y-6">

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Store Logo (Wajib 1:1)</label>

                            @php
                                $logoUrl = (isset($store) && $store->logo) ? asset('storage/' . $store->logo) : 'https://via.placeholder.com/100/F3F4F6/9CA3AF?text=No+Logo';
                            @endphp

                            <div class="mt-2 mb-4">
                                <img src="{{ $logoUrl }}" alt="Store Logo Preview"
                                    class="w-32 h-32 rounded-full object-cover border-4 border-dashed border-gray-200 p-1 shadow-md">
                                <p class="text-xs text-gray-500 mt-2">Current Logo</p>
                            </div>

                            <input type="file" name="logo"
                                class="w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-lg file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-gray-100 file:text-[#456845]
                                    hover:file:bg-gray-200 transition duration-150">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Max: 2MB. Disarankan rasio 1:1.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <button type="submit" class="w-full bg-[#456845] text-white py-3 rounded-lg font-bold hover:bg-green-700 transition shadow-md text-lg">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</x-app-layout>