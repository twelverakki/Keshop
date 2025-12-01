<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Incoming Orders') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 font-medium border border-green-200 shadow-md">{{ session('success') }}</div>
        @endif

        <div class="bg-white overflow-hidden shadow-2xl rounded-xl p-6 border border-gray-100">

            <div class="hidden lg:grid grid-cols-10 gap-4 text-xs uppercase text-gray-500 font-semibold tracking-wider mb-3 px-4">
                <div class="col-span-1">Date</div>
                <div class="col-span-1">Order ID</div>
                <div class="col-span-2">Customer</div>
                <div class="col-span-2">Product</div>
                <div class="col-span-1 text-center">Qty</div>
                <div class="col-span-1 text-center">Status</div>
                <div class="col-span-2 text-right">Action</div>
            </div>

            <div class="space-y-4">
                @forelse($orderItems as $item)
                    <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-200 grid grid-cols-1 lg:grid-cols-10 gap-4 items-center border border-gray-100">

                        <div class="lg:col-span-1 text-sm text-gray-600 font-medium">
                            {{ $item->created_at->format('d/m/y') }}
                        </div>

                        <div class="lg:col-span-1 font-mono font-bold text-gray-900 text-sm">
                            #{{ $item->order->id }}
                        </div>

                        <div class="lg:col-span-2">
                            <span class="font-bold block text-gray-800 text-sm">{{ $item->order->user->name }}</span>
                            <span class="text-xs text-gray-500">{{ $item->order->user->email }}</span>
                        </div>

                        <div class="lg:col-span-2 font-medium text-gray-700 text-sm flex items-center gap-2">
                             <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/40' }}"
                                alt="{{ $item->product->name }}"
                                class="w-8 h-8 object-cover rounded-md border border-gray-200 hidden sm:block"
                            >
                            <span class="truncate">{{ $item->product->name }}</span>
                        </div>

                        <div class="lg:col-span-1 text-center text-sm font-bold text-gray-700">
                            {{ $item->quantity }}
                        </div>

                        <div class="lg:col-span-1 text-center">
                            @php
                                $status = strtolower($item->order->status);
                                $color = match ($status) {
                                    'completed' => 'bg-green-100 text-green-800',
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'processing' => 'bg-blue-100 text-blue-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                    default => 'bg-gray-100 text-gray-600',
                                };
                            @endphp
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                {{ ucfirst($status) }}
                            </span>
                        </div>

                        <div class="lg:col-span-2 text-right lg:pl-4">
                            <form action="{{ route('seller.orders.update-status', $item->order->id) }}" method="POST" class="flex justify-end gap-2 mt-2 lg:mt-0">
                                @csrf @method('PATCH')

                                @if($item->order->status == 'pending')
                                    <button name="status" value="processing" title="Accept Order" class="bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-blue-700 transition shadow-sm">Accept</button>
                                    <button name="status" value="cancelled" title="Reject Order" class="bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-red-700 transition shadow-sm" onclick="return confirm('Are you sure you want to reject this order?')">Reject</button>
                                @elseif($item->order->status == 'processing')
                                    <button name="status" value="completed" title="Mark as Completed" class="bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-green-700 transition shadow-sm">Shipped/Done</button>
                                @else
                                    <span class="text-xs text-gray-400">No action needed</span>
                                @endif
                            </form>
                        </div>

                        <div class="col-span-10 text-xs text-gray-500 border-t pt-2 mt-2 lg:border-t-0 lg:pt-0 lg:mt-0">
                             <strong class="font-semibold text-gray-700">Ship to:</strong>
                             <span class="max-w-full truncate" title="{{ $item->order->address }}">{{ $item->order->address }}</span>
                        </div>

                    </div>
                @empty
                    <div class="p-6 text-center text-gray-500 font-medium bg-gray-50 rounded-lg">No order items found for your products.</div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $orderItems->links() }}
            </div>
        </div>
    </div>
</div>
</x-app-layout>