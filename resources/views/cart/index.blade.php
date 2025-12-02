<x-guest-layout>

    <div class="max-w-7xl mx-auto px-4 py-10 bg-gray-50">

    <h1 class="text-4xl font-extrabold text-gray-900 mb-8">Shopping Cart</h1>

    @if($cartItems->count() > 0)
    <div class="flex flex-col lg:flex-row gap-8">

        <div class="lg:w-2/3">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

                <div class="p-6 border-b border-gray-100 hidden sm:block">
                    <h3 class="text-lg font-bold text-gray-900">Your Items ({{ $cartItems->count() }} total)</h3>
                </div>

                @php $total = 0; @endphp
                @foreach($cartItems as $item)
                @php $subtotal = $item->product->price * $item->quantity; $total += $subtotal; @endphp

                <div class="flex flex-col sm:flex-row items-start sm:items-center p-6 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition duration-150">


                    <div class="flex sm:flex-col flex-row">
                        <div class="w-24 h-24 flex-shrink-0 rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                            <img src="{{ $item->product->image_url }}" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-1 pl-6 sm:hidden">
                            <h3 class="text-lg font-extrabold text-gray-900">{{ $item->product->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $item->product->category->name }}</p>
                            <p class="text-xs text-gray-500 mt-1">Seller: {{ $item->product->seller->name }}</p>

                            <p class="text-sm text-gray-600 font-medium mt-2">
                                Price: Rp {{ number_format($item->product->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 sm:mt-0 ml-0 sm:ml-6 flex-1 flex flex-col sm:flex-row justify-between w-full">

                        <div class="flex-1 pr-6 hidden sm:block">
                            <h3 class="text-lg font-extrabold text-gray-900">{{ $item->product->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $item->product->category->name }}</p>
                            <p class="text-xs text-gray-500 mt-1">Seller: {{ $item->product->seller->name }}</p>

                            <p class="text-sm text-gray-600 font-medium mt-2">
                                Price: Rp {{ number_format($item->product->price, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="flex items-center justify-between sm:justify-start gap-4 sm:gap-8 mt-4 sm:mt-0 flex-shrink-0">

                            <div x-data="{ quantity: {{ $item->quantity }} }">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" x-ref="qtyForm" class="flex items-center border border-gray-300 rounded-lg overflow-hidden shadow-sm">
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="button"
                                        @click="quantity = Math.max(1, quantity - 1); $nextTick(() => $refs.qtyForm.submit())"
                                        class="p-2 text-gray-600 hover:bg-gray-100 transition duration-150 text-base"
                                    >
                                        -
                                    </button>

                                    <input
                                        type="number"
                                        name="quantity"
                                        x-model="quantity"
                                        min="1"
                                        max="{{ $item->product->stock }}"
                                        class="w-12 text-base border-none focus:ring-0 text-center py-1 px-1 appearance-none hide-spin-buttons"
                                    >

                                    <button
                                        type="button"
                                        @click="quantity = Math.min({{ $item->product->stock }}, quantity + 1); $nextTick(() => $refs.qtyForm.submit())"
                                        class="p-2 text-gray-600 hover:bg-gray-100 transition duration-150 text-base"
                                    >
                                        +
                                    </button>
                                </form>
                            </div>

                            <div class="text-base font-bold text-[#456845] whitespace-nowrap hidden sm:block">
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </div>

                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-50 transition duration-150" title="Remove Item">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="lg:w-1/3">
            <div class="bg-white rounded-2xl shadow-2xl p-6 sticky top-28 border border-gray-100">
                <h3 class="text-xl font-extrabold text-gray-900 mb-6 border-b pb-3">Order Summary</h3>

                <div class="flex justify-between mb-4 text-gray-600">
                    <span>Subtotal</span>
                    <span class="font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between mb-6 text-gray-600">
                    <span>Shipping</span>
                    <span class="text-green-600 font-bold">FREE</span>
                </div>
                <div class="border-t border-gray-200 pt-4 flex justify-between mb-8">
                    <span class="text-2xl font-extrabold text-gray-900">Total Due</span>
                    <span class="text-2xl font-extrabold text-[#456845]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <form action="{{ route('checkout') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Shipping Address</label>
                        <textarea
                            name="address"
                            id="address"
                            rows="4"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#456845] focus:ring-[#456845] text-sm transition"
                            placeholder="Enter your full delivery address..."
                            required></textarea>
                    </div>

                    <button type="submit" class="w-full bg-[#456845] text-white py-3 rounded-lg font-extrabold hover:bg-green-700 transition shadow-xl flex justify-center items-center gap-2 text-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Confirm & Checkout
                    </button>
                </form>

            </div>
        </div>
    </div>
    @else
    <div class="text-center py-20 bg-white rounded-2xl shadow-xl border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Your Cart is Empty</h2>
        <p class="text-gray-500 mb-6">Start shopping now to fill your cart with amazing products!</p>
        <a href="{{ route('shop.index') }}" class="inline-block bg-[#456845] text-white px-8 py-3 rounded-lg font-bold hover:bg-green-700 transition shadow-md">Start Shopping</a>
    </div>
    @endif
</div>
</x-guest-layout>
