<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8 text-center">
        <h1 class="text-3xl font-black text-neutral-dark tracking-tighter mb-2">Admin Login</h1>
        <p class="text-slate-500 font-medium">Access Admin Dashboard</p>
    </div>

    <form method="POST" action="{{ route('admin.login.store') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Admin
                Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                class="w-full px-5 py-4 border-2 border-slate-200 rounded-2xl focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all font-bold text-neutral-dark"
                placeholder="admin@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <label for="password"
                class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-5 py-4 border-2 border-slate-200 rounded-2xl focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all font-bold text-neutral-dark"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-6">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox"
                    class="rounded border-slate-300 text-primary shadow-sm focus:ring-primary/20" name="remember">
                <span class="ml-2 text-sm text-slate-600 font-bold">Remember me</span>
            </label>
        </div>

        <div class="mt-8">
            <button type="submit"
                class="w-full py-5 bg-gradient-to-r from-primary to-primary-dark text-white font-black text-lg rounded-2xl hover:shadow-2xl hover:shadow-primary/30 transition-all active:scale-95">
                Login to Admin Panel
            </button>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('home') }}"
                class="text-sm text-slate-500 hover:text-primary transition-colors font-medium">
                ← Back to Homepage
            </a>
        </div>
    </form>
</x-guest-layout>