<x-guest-layout>
        <div class="min-h-[calc(100vh-64px)] max-w-7xl mx-auto px-4 py-6">

        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 mb-6">
                <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-2">Account Under Review</h2>
            <p class="text-gray-600 mb-8">
                Terima kasih telah mendaftar sebagai Seller di Hiyoucan. <br>
                Akun Anda sedang ditinjau oleh Admin. Harap tunggu persetujuan sebelum dapat mengelola toko.
            </p>

            <div class="border-t border-gray-200 pt-6">
                <p class="text-sm text-gray-500 mb-4">Ingin membatalkan pendaftaran?</p>

                <form method="POST" action="{{ route('profile.destroy') }}" class="inline-block w-full">
                    @csrf
                    @method('delete')

                    <x-danger-button class="w-full justify-center" onclick="return confirm('Are you sure you want to delete your account request?')">
                        {{ __('Delete Account Request') }}
                    </x-danger-button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 underline">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>

    </div>
</x-guest-layout>