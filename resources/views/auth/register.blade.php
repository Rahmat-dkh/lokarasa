<x-guest-layout>
    <div class="text-center mb-10">
        <h1 class="text-3xl font-black text-neutral-dark tracking-tighter mb-2">Daftar Pembeli.</h1>
        <p class="text-slate-500 font-medium">Buat akun untuk mulai belanja produk UMKM terbaik.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Nama
                Lengkap</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-slate-900 font-bold focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all placeholder:text-slate-300"
                placeholder="Nama Anda">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-6">
            <label for="email" class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Email
                Pembeli</label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-slate-900 font-bold focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all placeholder:text-slate-300"
                placeholder="nama@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <label for="password" class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Kata
                Sandi</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-slate-900 font-bold focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all placeholder:text-slate-300"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-6">
            <label for="password_confirmation"
                class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Konfirmasi Sandi</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                autocomplete="new-password"
                class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-slate-900 font-bold focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all placeholder:text-slate-300"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-10 space-y-4">
            <button type="submit"
                class="w-full h-14 bg-primary text-white font-black rounded-2xl shadow-xl shadow-primary/20 hover:bg-primary-dark transition-all active:scale-95">
                Daftar Sekarang
            </button>

            <div class="relative flex py-4 items-center">
                <div class="flex-grow border-t border-slate-100"></div>
                <span class="flex-shrink mx-4 text-xs font-black text-slate-300 uppercase tracking-widest">Atau</span>
                <div class="flex-grow border-t border-slate-100"></div>
            </div>

            <a href="{{ route('social.redirect', 'google') }}"
                class="flex items-center justify-center gap-3 w-full h-14 bg-white border-2 border-slate-100 text-neutral-dark font-black rounded-2xl shadow-lg shadow-black/5 hover:bg-slate-50 transition-all active:scale-95">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-6 w-6">
                Daftar dengan Google
            </a>
        </div>

        <div class="mt-10 text-center">
            <p class="text-sm font-bold text-slate-500">Sudah punya akun? <a href="{{ route('login') }}"
                    class="text-primary hover:text-primary-dark transition-colors">Masuk Sekarang</a></p>
        </div>
    </form>
</x-guest-layout>