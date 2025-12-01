<x-guest-layout>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-hiyoucan-900 mb-8">My Orders</h1>

        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide font-bold">Order ID</p>
                            <p class="text-gray-900 font-medium">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide font-bold">Date</p>
                            <p class="text-gray-900">{{ $order->created_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide font-bold">Total</p>
                            <p class="text-hiyoucan-700 font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $order->status == 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        @foreach($order->items as $item)
                        <div class="flex items-center py-2">
                            <img src="{{ $item->product->image }}" class="w-12 h-12 object-cover rounded bg-earth-100">
                            <div class="ml-4 flex-1">
                                <p class="text-gray-900 font-medium">{{ $item->product->name }}</p>
                                <p class="text-xs text-gray-500">Qty: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-gray-900 font-medium">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-xl shadow-sm">
                <p class="text-gray-500 mb-4">You haven't placed any orders yet.</p>
                <a href="{{ route('shop.index') }}" class="inline-block bg-hiyoucan-600 text-white px-6 py-2 rounded-lg hover:bg-hiyoucan-700">Start Shopping</a>
            </div>
        @endif
    </div>
</x-guest-layout>
