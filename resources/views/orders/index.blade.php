<x-guest-layout>

    <div class="max-w-7xl mx-auto px-4 pt-6 pb-12">
        <div class="flex justify-between items-end mb-8">
            <h1 class="text-3xl font-bold text-[#2f442f]">My Orders</h1>
            <a href="{{ route('shop.index') }}" class="text-[#456845] hover:underline text-sm">Continue Shopping</a>
        </div>

        @if(isset($orders) && $orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
               <div class="bg-gray-50 px-6 py-4 border-b border-gray-900">
                        <div class="flex flex-wrap gap-6 justify-between items-start">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-bold">Order ID</p>
                                <p class="text-gray-900 font-medium">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-bold">Date</p>
                                <p class="text-gray-900">{{ $order->created_at->format('d M Y') }}</p>
                            </div>
                            <div class="flex-1 min-w-[200px]">
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-bold">Shipping To</p>
                                <p class="text-gray-900 text-sm truncate">{{ $order->address }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-bold">Total Amount</p>
                                <p class="text-[#456845] font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $order->status == 'processing' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $order->status == 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="mx-auto h-12 w-12 text-gray-300 mb-4">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No orders</h3>
                <p class="mt-1 text-sm text-gray-500">You haven't placed any orders yet.</p>
                <div class="mt-6">
                    <a href="{{ route('shop.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#456845] hover:bg-[#2f442f] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#578357]">
                        Start Shopping
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-guest-layout>
