<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-sm text-gray-600 uppercase border-b border-gray-200">
                                <th class="p-4">Name / Email</th>
                                <th class="p-4">Current Role</th>
                                <th class="p-4">Change Role</th>
                                <th class="p-4">Seller Status</th>
                                <th class="p-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4">
                                    <p class="font-bold text-gray-900">{{ $user->name }}</p>
                                    <p class="text-gray-500 text-xs">{{ $user->email }}</p>
                                </td>
                                <td class="p-4">
                                    @if($user->role == 'seller')
                                        <span class="px-2 py-1 rounded text-xs font-bold bg-purple-100 text-purple-700">Seller</span>
                                    @elseif($user->role == 'user')
                                        <span class="px-2 py-1 rounded text-xs font-bold bg-blue-100 text-blue-700">Buyer</span>
                                    @else
                                        <span class="px-2 py-1 rounded text-xs font-bold bg-gray-100 text-gray-700">{{ ucfirst($user->role) }}</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <form action="{{ route('admin.users.update-role', $user->id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role" class="text-xs border-gray-300 rounded shadow-sm focus:ring-hiyoucan-500 focus:border-hiyoucan-500 py-1">
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Buyer</option>
                                            <option value="seller" {{ $user->role == 'seller' ? 'selected' : '' }}>Seller</option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                        <button type="submit" class="text-xs bg-gray-800 text-white px-2 py-1 rounded hover:bg-gray-700">Save</button>
                                    </form>
                                </td>
                                <td class="p-4">
                                    @if($user->role == 'seller')
                                        @if($user->email_verified_at)
                                            <span class="text-green-600 font-bold text-xs flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Approved
                                            </span>
                                        @else
                                            <span class="text-orange-500 font-bold text-xs flex items-center gap-1 animate-pulse">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Pending
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="p-4 text-right space-x-2">
                                    @if($user->role == 'seller')
                                        <form action="{{ route('admin.users.verify', $user->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @if(!$user->email_verified_at)
                                                <input type="hidden" name="action" value="approve">
                                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700">Approve</button>
                                            @else
                                                <input type="hidden" name="action" value="reject">
                                                <button type="submit" class="bg-orange-500 text-white px-3 py-1 rounded text-xs hover:bg-orange-600">Reject</button>
                                            @endif
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this user permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>