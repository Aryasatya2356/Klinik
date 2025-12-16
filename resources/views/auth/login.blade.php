<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex flex-col items-center justify-center mb-6">
        <img src="{{ asset('images/logo.png') }}" alt="Logo SINKLUS" class="w-24 h-auto drop-shadow-sm">
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-5">
            <label for="email" class="block font-bold text-sm text-gray-800 mb-2">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                class="w-full rounded-md border border-gray-300 bg-gray-200 text-gray-900 shadow-sm p-3
                    focus:border-[#A4C96A] focus:ring-2 focus:ring-[#A4C96A] focus:bg-white transition duration-200"
                placeholder="Masukkan email">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-5">
            <label for="password" class="block font-bold text-sm text-gray-800 mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full rounded-md border border-gray-300 bg-gray-200 text-gray-900 shadow-sm p-3
                    focus:border-[#A4C96A] focus:ring-2 focus:ring-[#A4C96A] focus:bg-white transition duration-200"
                placeholder="Masukkan password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4 mb-8">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" 
                    class="rounded border-gray-300 text-[#A4C96A] shadow-sm focus:ring-[#A4C96A]" 
                    name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 font-semibold" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-end">
            <button type="submit" 
                    class="bg-[#A4C96A] hover:bg-[#8eb555] text-[#1a3d1f] font-bold py-2 px-8 rounded shadow-md transition duration-300 uppercase tracking-widest text-sm">
                {{ __('LOG IN') }}
            </button>
        </div>
    </form>
</x-guest-layout>