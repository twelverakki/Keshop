<aside>
    <h2 class="text-xl font-bold text-gray-800 mb-4">Category</h2>
    <div class="space-y-2">
        <a href="#" class="flex justify-between items-center text-red-500 font-semibold text-sm py-1">
            All Product
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </a>

        <div class="space-y-2 border-l border-gray-200 pl-4 ml-1">
            @foreach ($categories as $category)
            <div class="flex items-center text-gray-600 hover:text-gray-900 transition text-sm">
                <input id="cat-{{ $category->id }}" name="category[]" type="checkbox" class="h-4 w-4 text-black border-gray-300 rounded focus:ring-black">
                <label for="cat-{{ $category->id }}" class="ml-3">{{ $category->name }}</label>
            </div>
            @endforeach
        </div>

    </div>

    <div class="border-t border-gray-200 mt-6 pt-6 space-y-3">
        @php
            $options = ['New Arrival', 'On Discount'];
        @endphp
        @foreach ($options as $option)
        <div class="flex items-center text-gray-600 hover:text-gray-900 transition text-sm">
            <input id="opt-{{ Str::slug($option) }}" name="option[]" type="checkbox" class="h-4 w-4 text-black border-gray-300 rounded focus:ring-black">
            <label for="opt-{{ Str::slug($option) }}" class="ml-3">{{ $option }}</label>
        </div>
        @endforeach
    </div>
</aside>