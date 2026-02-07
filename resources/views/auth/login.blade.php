<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-2xl sm:text-3xl font-black text-neutral-dark tracking-tighter mb-1">Masuk Akun.</h1>
        <p class="text-xs sm:text-sm text-slate-500 font-medium">Silakan masuk untuk melanjutkan.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email"
                class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus
                class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-xl text-slate-900 text-sm font-bold focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all placeholder:text-slate-300"
                placeholder="nama@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="mt-3">
            <div class="flex justify-between items-center mb-1.5">
                <label for="password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Kata
                    Sandi</label>
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-bold text-primary hover:text-primary-dark transition-colors"
                        href="{{ route('password.request') }}">
                        Lupa Sandi?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-xl text-slate-900 text-sm font-bold focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all placeholder:text-slate-300"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-3">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox"
                    class="rounded border-2 border-slate-200 text-primary shadow-sm focus:ring-primary transition-all w-4 h-4"
                    name="remember">
                <span
                    class="ms-2 text-xs font-bold text-slate-500 group-hover:text-neutral-dark transition-colors">Ingat
                    saya</span>
            </label>
        </div>

        <div class="mt-5 space-y-3">
            <button type="submit"
                class="w-full h-12 bg-primary text-white font-black rounded-xl shadow-lg shadow-primary/20 hover:bg-primary-dark transition-all active:scale-95 text-sm">
                Masuk Sekarang
            </button>

            <div class="relative flex py-2 items-center">
                <div class="flex-grow border-t border-slate-100"></div>
                <span
                    class="flex-shrink mx-3 text-[10px] font-black text-slate-300 uppercase tracking-widest">Atau</span>
                <div class="flex-grow border-t border-slate-100"></div>
            </div>

            <a href="{{ route('social.redirect', 'google') }}"
                class="flex items-center justify-center gap-2 w-full h-12 bg-white border-2 border-slate-100 text-neutral-dark font-black rounded-xl shadow-md shadow-black/5 hover:bg-slate-50 transition-all active:scale-95 text-sm">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-5 w-5">
                Lanjutkan dengan Google
            </a>
        </div>

        <div class="mt-5 text-center">
            <p class="text-xs font-bold text-slate-500">Belum punya akun? <a href="{{ route('register') }}"
                    class="text-primary hover:text-primary-dark transition-colors">Daftar Sekarang</a></p>
        </div>
    </form>

    <div class="mt-6 pt-4 border-t border-slate-100 text-center">
        <p class="text-xs font-medium text-slate-500 mb-2">Mitra UMKM?</p>
        <a href="{{ route('vendor.register') }}"
            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-neutral-dark text-white text-sm font-bold rounded-xl hover:bg-neutral-800 transition-all shadow-md shadow-neutral-dark/20 w-full sm:w-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z">
                </path>
            </svg>
            Daftar / Masuk Vendor
        </a>
    </div>
</x-guest-layout>