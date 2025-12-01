<x-auth-layout>
    <div class="min-h-screen flex items-center justify-center py-12">

        <div
            class="max-w-md w-full z-10 overflow-hidden shadow-2xl rounded-xl p-8 border-none outline-none px-[7px] text-white text-[15px] bg-transparent backdrop-blur-sm shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4)] focus:shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4),inset_3px_3px_10px_rgba(0,0,0,1),inset_-1px_-1px_6px_rgba(255,255,255,0.4)]">

            <div class="text-center text-white">

                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-orange-100 mb-6 border-4 border-orange-200">
                    <svg class="h-10 w-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>

                <h2 class="text-3xl text-gray-900 font-extrabold mb-3">Akun Dalam Peninjauan</h2>
                <p class=" mb-8 leading-relaxed">
                    Terima kasih telah mendaftar sebagai Seller. Permintaan Anda telah diterima dan **sedang ditinjau oleh tim Admin**. <br>
                    Kami akan mengirimkan notifikasi persetujuan ke email Anda.
                </p>


                <div class="border-t border-gray-200 pt-6 space-y-3">
                    <p class="text-sm font-semibold  mb-4">Ingin membatalkan pendaftaran?</p>

                    <form method="POST" action="{{ route('profile.destroy') }}" class="w-full">
                        @csrf
                        @method('delete')
                        <button type="submit" class="w-full justify-center bg-red-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-700 transition shadow-md"
                            onclick="return confirm('Apakah Anda yakin ingin membatalkan dan menghapus permintaan akun Anda secara permanen?')">
                            Batalkan Pendaftaran & Hapus Akun
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="text-sm hover:underline mt-4">
                            Log Out dari Akun
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>