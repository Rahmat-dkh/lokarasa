<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-800 leading-tight tracking-tight">
            {{ __('Dashboard Vendor') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Shop Welcome Banner -->
            <div
                class="relative overflow-hidden bg-primary rounded-[2rem] p-8 mb-8 text-white shadow-2xl shadow-primary/20">
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <h1 class="text-3xl font-black mb-2 italic">Halo, {{ $vendor->shop_name }}!</h1>
                        <p class="text-primary-light text-sm font-medium opacity-90 max-w-md">Senang melihat Anda
                            kembali. Mari kelola toko Anda dan tingkatkan penjualan hari ini.</p>
                    </div>
                    <div class="flex gap-3 w-full md:w-auto">
                        <a href="{{ route('shop.show', $vendor->slug) }}" target="_blank"
                            class="flex-1 md:flex-none px-6 py-3 bg-white/20 backdrop-blur-md hover:bg-white/30 text-white rounded-2xl font-black text-xs uppercase tracking-widest transition-all text-center">
                            Lihat Toko Publik
                        </a>
                        <a href="{{ route('vendor.products.create') }}"
                            class="flex-1 md:flex-none px-6 py-3 bg-white text-primary hover:bg-slate-50 text-xs font-black uppercase tracking-widest rounded-2xl transition-all shadow-lg text-center">
                            + Tambah Produk
                        </a>
                    </div>
                </div>
                <!-- Decorative Circle -->
                <div class="absolute -right-10 -top-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -left-10 -bottom-10 w-48 h-48 bg-black/10 rounded-full blur-2xl"></div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Wallet Card -->
                <div
                    class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Saldo Dompet</p>
                            <h3 class="text-xl font-black text-slate-800">Rp {{ number_format($balance, 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>
                    <a href="{{ route('vendor.wallet.index') }}"
                        class="flex items-center justify-center w-full py-2.5 bg-slate-50 text-slate-600 hover:text-primary hover:bg-primary/5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                        Kelola Keuangan &rarr;
                    </a>
                </div>

                <!-- Products Card -->
                <div
                    class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Produk</p>
                            <h3 class="text-xl font-black text-slate-800">{{ $productsCount }} <span
                                    class="text-xs text-slate-400 font-bold ml-1">Aktif</span></h3>
                        </div>
                    </div>
                    <a href="{{ route('vendor.products.index') }}"
                        class="flex items-center justify-center w-full py-2.5 bg-slate-50 text-slate-600 hover:text-primary hover:bg-primary/5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                        Daftar Produk &rarr;
                    </a>
                </div>

                <!-- Orders Card -->
                <div
                    class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Pesanan</p>
                            <h3 class="text-xl font-black text-slate-800">{{ $ordersCount }} <span
                                    class="text-xs text-slate-400 font-bold ml-1">Transaksi</span></h3>
                        </div>
                    </div>
                    <a href="{{ route('vendor.orders.index') }}"
                        class="flex items-center justify-center w-full py-2.5 bg-slate-50 text-slate-600 hover:text-primary hover:bg-primary/5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                        Riwayat Pesanan &rarr;
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Orders Table -->
                <div class="lg:col-span-2">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base font-black text-slate-800 tracking-tight flex items-center gap-2">
                            <span class="w-1 h-5 bg-primary rounded-full"></span>
                            Pesanan Terbaru
                        </h3>
                        <a href="{{ route('vendor.orders.index') }}"
                            class="text-[10px] font-bold text-primary hover:underline uppercase tracking-widest">Detail
                            →</a>
                    </div>

                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                        @if($ordersCount > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-slate-50/50">
                                            <th
                                                class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                                ID Pesanan</th>
                                            <th
                                                class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                                Waktu</th>
                                            <th
                                                class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                                Total</th>
                                            <th
                                                class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                                Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50">
                                        @forelse($recentOrders as $order)
                                                                    <tr class="hover:bg-slate-50/50 transition-colors group">
                                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                                            <span
                                                                                class="text-xs font-black text-slate-800 tracking-tight group-hover:text-primary transition-colors">
                                                                                #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                                                            </span>
                                                                        </td>
                                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                                            <div class="flex flex-col">
                                                                                <span
                                                                                    class="text-[11px] font-bold text-slate-700">{{ $order->created_at->format('d M Y') }}</span>
                                                                                <span
                                                                                    class="text-[9px] font-black text-slate-400 italic">{{ $order->created_at->format('H:i') }}
                                                                                    WIB</span>
                                                                            </div>
                                                                        </td>
                                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                                            <span class="text-xs font-black text-slate-900 italic">
                                                                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                                                            </span>
                                                                        </td>
                                                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                                                            <span
                                                                                class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest
                                                                                        {{ $order->status === 'completed' ? 'bg-emerald-50 text-emerald-500' :
                                            ($order->status === 'pending' ? 'bg-amber-50 text-amber-500' : 'bg-slate-50 text-slate-400') }}">
                                                                                {{ $order->status }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-12 text-center text-slate-400 italic text-sm">
                                                    Belum ada pesanan masuk.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="p-16 text-center">
                                <div
                                    class="bg-slate-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-slate-800 font-black mb-1">Belum Ada Pesanan</h4>
                                <p class="text-slate-400 text-sm italic">Sabar ya, rejeki tidak akan tertukar!</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Shop Quick Settings -->
                <div>
                    <h3 class="text-lg font-black text-slate-800 tracking-tight mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-slate-300 rounded-full"></span>
                        Pengaturan Toko
                    </h3>
                    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm">
                        <form action="{{ route('vendor.settings.update') }}" method="POST" class="space-y-5">
                            @csrf
                            @method('PUT')

                            <div>
                                <label
                                    class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Nama
                                    Toko</label>
                                <input type="text" name="shop_name" value="{{ $vendor->shop_name }}"
                                    class="w-full px-4 py-3 bg-slate-50 border-transparent rounded-xl text-slate-800 text-sm font-bold focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all">
                            </div>

                            <div>
                                <label
                                    class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Ongkir
                                    Flat (Per Pesanan)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="text-slate-400 font-bold text-sm">Rp</span>
                                    </div>
                                    <input type="number" name="flat_shipping_cost"
                                        value="{{ $vendor->flat_shipping_cost }}"
                                        class="w-full pl-12 pr-4 py-3 bg-slate-50 border-transparent rounded-xl text-slate-800 text-sm font-bold focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all">
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Deskripsi</label>
                                <textarea name="description" rows="3"
                                    class="w-full px-4 py-3 bg-slate-50 border-transparent rounded-xl text-slate-800 text-sm font-bold focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all resize-none">{{ $vendor->description }}</textarea>
                            </div>

                            <button type="submit"
                                class="w-full py-3.5 bg-neutral-dark text-white font-black text-xs uppercase tracking-widest rounded-xl hover:bg-neutral-800 transition-all shadow-lg active:scale-95">
                                Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>