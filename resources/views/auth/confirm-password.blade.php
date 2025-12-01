<x-auth-layout title="Security Check" heading="Password Confirmation" subheading="Please enter your password to proceed to the secure area.">

    <div class="w-full">

        {{-- Area Pesan Utama --}}
        <div class="mb-6 p-4 rounded-lg bg-white/10 text-white text-sm shadow-inner">
            <p class="font-bold mb-1">
                {{ __('This is a secure area of the application.') }}
            </p>
            <p>
                {{ __('Please confirm your password before continuing.') }}
            </p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="flex flex-col w-full gap-6">
            @csrf

            {{-- Password Input --}}
            <div
                class="flex-[0_0_auto] flex flex-col w-full gap-[7px] relative text-white px-2"
            >
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="peer h-[45px] rounded-lg border-none outline-none px-[15px] text-white text-[15px] bg-transparent backdrop-blur-sm shadow-[3px_3px_10px_rgba(0,0,0,1),-1px_-1px_6px_rgba(255,255,255,0.4)] focus:shadow-[0_0_10px_rgba(255,255,255,0.5)]"
                    placeholder=" "
                />
                <label for="password"
                    class="absolute left-[18px] top-[13px] text-[15px] transition-all"
                >
                    Password
                </label>
                {{-- Error Message (Jika ada) --}}
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end mt-4 px-2">
                {{-- Confirm Button --}}
                <button
                    type="submit"
                    class="h-[45px] px-8 rounded-lg border-none text-white text-[15px] font-bold transition hover:opacity-90 bg-blue-600 shadow-md"
                >
                    {{ __('Confirm') }}
                </button>
            </div>
        </form>
    </div>
</x-auth-layout>