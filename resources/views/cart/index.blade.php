<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>My Cart - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-earth-100/30 font-sans antialiased text-gray-700 mt-12">

    @include('layouts.public-nav')

    <div class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-hiyoucan-900 pl-6 mb-8">Shopping Cart</h1>

        @if($cartItems->count() > 0)
        <div class="flex flex-col lg:flex-row gap-8">
            <div class="lg:w-2/3">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    @php $total = 0; @endphp
                    @foreach($cartItems as $item)
                    @php $subtotal = $item->product->price * $item->quantity; $total += $subtotal; @endphp
                    
                    <div class="flex items-center p-6 border-b border-gray-100 last:border-0">
                        <div class="w-24 h-24 flex-shrink-0 bg-earth-100 rounded-md overflow-hidden">
                            <img src="{{ $item->product->image }}" class="w-full h-full object-cover">
                        </div>
                        
                        <div class="ml-6 flex-1">
                            <h3 class="text-lg font-bold text-gray-900">{{ $item->product->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $item->product->category->name }}</p>
                            <p class="text-hiyoucan-700 font-medium mt-1">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                        </div>

                        <div class="flex items-center gap-6">
                            <div class="text-sm text-gray-600">
                                Qty: <span class="font-bold">{{ $item->quantity }}</span>
                            </div>
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:w-1/3">
                <div class="bg-white rounded-xl shadow-sm p-6 sticky top-28">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Order Summary</h3>
                    <div class="flex justify-between mb-4 text-gray-600">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between mb-6 text-gray-600">
                        <span>Shipping</span>
                        <span class="text-green-600 font-medium">Free</span>
                    </div>
                    <div class="border-t border-gray-200 pt-4 flex justify-between mb-8">
                        <span class="text-xl font-bold text-gray-900">Total</span>
                        <span class="text-xl font-bold text-hiyoucan-700">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        
                        <div class="mb-6">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Shipping Address</label>
                            <textarea 
                                name="address" 
                                id="address" 
                                rows="3" 
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-hiyoucan-500 focus:ring-hiyoucan-500 text-sm" 
                                placeholder="Enter your full delivery address..."
                                required></textarea>
                        </div>

                        <button type="submit" class="w-full bg-hiyoucan-800 text-white py-3 rounded-lg font-bold hover:bg-hiyoucan-900 transition shadow-lg flex justify-center items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Confirm & Checkout
                        </button>
                    </form>

                </div>
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-xl shadow-sm">
                <p class="text-gray-500 mb-4">Your cart is currently empty.</p>
                <a href="{{ route('shop.index') }}" class="inline-block bg-hiyoucan-600 text-white px-6 py-2 rounded-lg hover:bg-hiyoucan-700">Start Shopping</a>
            </div>
        @endif
    </div>

</body>
</html>