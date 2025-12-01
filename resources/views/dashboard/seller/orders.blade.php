<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Incoming Orders') }}
        </h2>
    </x-slot>
    <div class="py-8 bg-gray-50"> {{-- Tambahkan bg-gray-50 untuk kontras --}}
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Pesan Notifikasi --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 font-medium border border-green-200 shadow-md">{{ session('success') }}</div>
        @endif

        <div class="bg-white overflow-hidden shadow-2xl rounded-xl p-6 border border-gray-100">

            {{-- HEADER / KOLOM KUNCI --}}
            <div class="hidden lg:grid grid-cols-10 gap-4 text-xs uppercase text-gray-500 font-semibold tracking-wider mb-3 px-4">
                <div class="col-span-1">Date</div>
                <div class="col-span-1">Order ID</div>
                <div class="col-span-2">Customer</div>
                <div class="col-span-2">Product</div>
                <div class="col-span-1 text-center">Qty</div>
                <div class="col-span-1 text-center">Status</div>
                <div class="col-span-2 text-right">Action</div>
            </div>

            {{-- LIST KARTU PESANAN --}}
            <div class="space-y-4">
                @forelse($orderItems as $item)
                    {{-- Setiap item pesanan adalah 'kartu' terpisah --}}
                    <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-200 grid grid-cols-1 lg:grid-cols-10 gap-4 items-center border border-gray-100">

                        {{-- 1. Date (Mobile: di atas) --}}
                        <div class="lg:col-span-1 text-sm text-gray-600 font-medium">
                            {{ $item->created_at->format('d/m/y') }}
                        </div>

                        {{-- 2. Order ID --}}
                        <div class="lg:col-span-1 font-mono font-bold text-gray-900 text-sm">
                            #{{ $item->order->id }}
                        </div>

                        {{-- 3. Customer --}}
                        <div class="lg:col-span-2">
                            <span class="font-bold block text-gray-800 text-sm">{{ $item->order->user->name }}</span>
                            <span class="text-xs text-gray-500">{{ $item->order->user->email }}</span>
                        </div>

                        {{-- 4. Product --}}
                        <div class="lg:col-span-2 font-medium text-gray-700 text-sm flex items-center gap-2">
                             {{-- Asumsi Anda memiliki image_url di OrderItem/Product --}}
                             <img src="{{ $item->product->image_url ?? 'https://via.placeholder.com/40' }}"
                                alt="{{ $item->product->name }}"
                                class="w-8 h-8 object-cover rounded-md border border-gray-200 hidden sm:block"
                            >
                            <span class="truncate">{{ $item->product->name }}</span>
                        </div>

                        {{-- 5. Qty --}}
                        <div class="lg:col-span-1 text-center text-sm font-bold text-gray-700">
                            {{ $item->quantity }}
                        </div>

                        {{-- 6. Status --}}
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

                        {{-- 7. Action --}}
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

                        {{-- Detail Alamat (Mobile/Desktop) --}}
                        <div class="col-span-10 text-xs text-gray-500 border-t pt-2 mt-2 lg:border-t-0 lg:pt-0 lg:mt-0">
                             <strong class="font-semibold text-gray-700">Ship to:</strong>
                             <span class="max-w-full truncate" title="{{ $item->order->address }}">{{ $item->order->address }}</span>
                        </div>

                    </div>
                @empty
                    <div class="p-6 text-center text-gray-500 font-medium bg-gray-50 rounded-lg">No order items found for your products.</div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $orderItems->links() }}
            </div>
        </div>
    </div>
</div>

{{-- <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 font-medium border border-green-200 shadow-sm">{{ session('success') }}</div>
        @endif

        <div class="bg-white overflow-hidden shadow-2xl rounded-xl border border-gray-100">
            <div class="p-6">

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm divide-y divide-gray-200">
                        <thead class="bg-gray-50 uppercase text-xs text-gray-600 tracking-wider">
                            <tr>
                                <th class="p-4">Date</th>
                                <th class="p-4">Order ID</th>
                                <th class="p-4">Customer</th>
                                <th class="p-4">Address</th>
                                <th class="p-4">Product</th>
                                <th class="p-4 text-center">Qty</th>
                                <th class="p-4 text-center">Status</th>
                                <th class="p-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($orderItems as $item)
                            <tr class="hover:bg-gray-50 transition duration-100">

                                <td class="p-4 text-gray-500 whitespace-nowrap">{{ $item->created_at->format('d/m/y') }}</td>

                                <td class="p-4 font-mono font-bold text-gray-800">#{{ $item->order->id }}</td>

                                <td class="p-4">
                                    <span class="font-bold block text-gray-800">{{ $item->order->user->name }}</span>
                                    <span class="text-xs text-gray-500">{{ $item->order->user->email }}</span>
                                </td>

                                <td class="p-4 max-w-xs truncate text-gray-600" title="{{ $item->order->address }}">
                                    {{ $item->order->address }}
                                </td>

                                <td class="p-4 font-medium text-gray-700">{{ $item->product->name }}</td>

                                <td class="p-4 text-center font-medium">{{ $item->quantity }}</td>

                                <td class="p-4 text-center">
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
                                </td>

                                <td class="p-4 text-right">
                                    <form action="{{ route('seller.orders.update-status', $item->order->id) }}" method="POST" class="flex justify-end gap-2">
                                        @csrf @method('PATCH')

                                        @if($item->order->status == 'pending')
                                            <button name="status" value="processing" title="Accept Order" class="bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-blue-700 transition shadow-sm">Accept</button>
                                            <button name="status" value="cancelled" title="Reject Order" class="bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-red-700 transition shadow-sm" onclick="return confirm('Are you sure you want to reject this order?')">Reject</button>
                                        @elseif($item->order->status == 'processing')
                                            <button name="status" value="completed" title="Mark as Completed" class="bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-green-700 transition shadow-sm">Shipped/Done</button>
                                        @else
                                            <span class="text-xs text-gray-400">No action</span>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="p-6 text-center text-gray-500 font-medium">No order items found for your products.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $orderItems->links() }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
</x-app-layout>