@props(['categories'])

<div x-show="filterModalOpen" x-cloak
    class="lg:hidden fixed inset-0 z-50 bg-white overflow-y-auto"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-full"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-full">

    <div class="p-4 pt-8 h-full flex flex-col">

        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-[#2f442f]">Filters</h2>
            <button @click="filterModalOpen=false" class="text-gray-500 hover:text-gray-700">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form id="filter-form-mobile" action="{{ route('shop.index') }}" method="GET" class="flex-1 space-y-8 overflow-y-auto pb-20">

            @foreach(request()->except(['search', 'sort', 'categories', 'page']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <div>
                <h4 class="font-bold text-gray-800 mb-3 text-sm uppercase tracking-wide">Search</h4>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Find products..." class="w-full pl-10 border-gray-200 bg-gray-50 rounded-lg text-sm focus:ring-[#76a576] focus:border-[#76a576] transition">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <label class="text-sm text-gray-500">Sort:</label>
                <select name="sort" class="w-full border-none bg-gray-50 text-sm font-bold text-gray-700 rounded-lg focus:ring-0 cursor-pointer hover:bg-gray-100 transition py-2 pl-3 pr-8">
                    <option value="">choose</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High</option>
                </select>
            </div>

            <div>
                <h4 class="font-bold text-gray-800 mb-3 text-sm uppercase tracking-wide">Categories</h4>
                <div class="space-y-3">
                    @foreach($categories as $category)
                    <label class="flex items-center space-x-3 cursor-pointer group">
                        <div class="relative flex items-center">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
                                class="peer h-5 w-5 cursor-pointer appearance-none rounded border border-gray-300 shadow-sm checked:bg-[#578357] checked:border-[#578357] focus:ring-[#76a576] transition">
                            <svg class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-3.5 h-3.5 text-white opacity-0 peer-checked:opacity-100 pointer-events-none transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-gray-600 group-hover:text-[#456845] transition flex-1 text-sm font-medium">
                            {{ $category->name }}
                        </span>
                        <span class="text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">{{ $category->products_count }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

        </form>

        <div class="fixed bottom-0 left-0 right-0 p-4 bg-white shadow-2xl border-t border-gray-100">
             <a href="{{ route('shop.index') }}" class="w-full block text-center text-xs text-red-500 hover:text-red-700 font-bold uppercase tracking-wider mb-2">Reset Filters</a>
             <button type="submit" form="filter-form-mobile" class="w-full bg-[#395339] text-white py-3 rounded-xl font-bold hover:bg-[#2f442f] transition shadow-lg">
                Apply Filters
            </button>
        </div>

    </div>
</div>