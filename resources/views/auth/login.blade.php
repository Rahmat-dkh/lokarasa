<x-guest-layout>
    <div class="text-center mb-8">
        <h1 class="text-2xl sm:text-3xl font-black text-neutral-dark tracking-tighter mb-2">Masuk Pembeli.</h1>
        <p class="text-sm sm:text-base text-slate-500 font-medium">Beli produk UMKM terbaik pilihan Anda.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Email
                Pembeli</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus
                class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-slate-900 font-bold focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all placeholder:text-slate-300"
                placeholder="nama@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-xs font-black text-slate-400 uppercase tracking-widest">Kata
                    Sandi</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-primary hover:text-primary-dark transition-colors"
                        href="{{ route('password.request') }}">
                        Lupa Sandi?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-slate-900 font-bold focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all placeholder:text-slate-300"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox"
                    class="rounded-lg border-2 border-slate-200 text-primary shadow-sm focus:ring-primary transition-all"
                    name="remember">
                <span
                    class="ms-3 text-sm font-bold text-slate-500 group-hover:text-neutral-dark transition-colors">Ingat
                    saya</span>
            </label>
        </div>

        <div class="mt-6 space-y-4">
            <button type="submit"
                class="w-full h-14 bg-primary text-white font-black rounded-2xl shadow-xl shadow-primary/20 hover:bg-primary-dark transition-all active:scale-95">
                Masuk Sekarang
            </button>

            <div class="relative flex py-4 items-center">
                <div class="flex-grow border-t border-slate-100"></div>
                <span class="flex-shrink mx-4 text-xs font-black text-slate-300 uppercase tracking-widest">Atau</span>
                <div class="flex-grow border-t border-slate-100"></div>
            </div>

            <a href="{{ route('social.redirect', 'google') }}"
                class="flex items-center justify-center gap-3 w-full h-14 bg-white border-2 border-slate-100 text-neutral-dark font-black rounded-2xl shadow-lg shadow-black/5 hover:bg-slate-50 transition-all active:scale-95">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-6 w-6">
                Lanjutkan dengan Google
            </a>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm font-bold text-slate-500">Belum punya akun? <a href="{{ route('register') }}"
                    class="text-primary hover:text-primary-dark transition-colors">Daftar Sekarang</a></p>
        </div>
    </form>
</x-guest-layout>