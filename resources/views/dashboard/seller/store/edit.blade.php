<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Store Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('seller.store.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Store Name</label>
                            <input type="text" name="name" value="{{ old('name', $store->name ?? Auth::user()->name . "'s Store") }}" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring[#76a576] focus:border[#76a576]" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" rows="4" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-[#76a576] focus:border[#76a576]">{{ old('description', $store->description ?? '') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Ceritakan sedikit tentang toko Anda.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Store Logo</label>

                            @if(isset($store) && $store->logo)
                                <div class="mt-2 mb-4">
                                    <img src="{{ asset('storage/' . $store->logo) }}" alt="Logo" class="w-24 h-24 rounded-full object-cover border border-gray-200">
                                </div>
                            @endif

                            <input type="file" name="logo" class="mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-hiyoucan-50 file:text-[#456845] hover:file:bg-hiyoucan-100">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Max: 2MB.</p>
                        </div>

                        <button type="submit" class="w-full bg-[#456845] text-white py-3 rounded-md font-bold hover:bg-hiyoucan-800">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>