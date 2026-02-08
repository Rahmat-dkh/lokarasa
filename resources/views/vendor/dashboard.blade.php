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
                        Kelola Saldo &rarr;
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
                        @if($recentOrders->isNotEmpty())
                            <!-- Desktop Table -->
                            <div class="hidden sm:block overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-slate-50/50">
                                            <th
                                                class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                                ID</th>
                                            <th
                                                class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                                Pembeli</th>
                                            <th
                                                class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                                Barang</th>
                                            <th
                                                class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                                Pendapatan</th>
                                            <th
                                                class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                                Status</th>
                                            <th
                                                class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50">
                                        @foreach($recentOrders as $order)
                                                                    <tr class="hover:bg-slate-50/50 transition-colors group">
                                                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                                                            <span
                                                                                class="text-xs font-black text-slate-800 tracking-tight group-hover:text-primary transition-colors">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                                                        </td>
                                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                                            <div class="flex flex-col">
                                                                                <span
                                                                                    class="text-xs font-bold text-slate-800">{{ $order->user->name }}</span>
                                                                                <div class="flex items-center gap-2">
                                                                                    <span
                                                                                        class="text-[10px] font-black text-primary/70 tracking-tight">{{ $order->phone ?: ($order->user->phone ?: ($order->user->addresses()->latest()->first()->phone ?? '-')) }}</span>
                                                                                    @if($order->phone || $order->user->phone || $order->user->addresses()->exists())
                                                                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->phone ?: ($order->user->phone ?: ($order->user->addresses()->latest()->first()->phone ?? ''))) }}" target="_blank" class="text-emerald-500 hover:text-emerald-600 transition-colors" title="WhatsApp">
                                                                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                                                                        </a>
                                                                                    @endif
                                                                                </div>
                                                                                <span
                                                                                    class="text-[9px] font-black text-slate-400 italic lowercase">{{ $order->created_at->format('d M, H:i') }}</span>
                                                                            </div>
                                                                        </td>
                                                                        <td class="px-6 py-4">
                                                                            <div class="space-y-1">
                                                                                @foreach($order->items->take(2) as $item)
                                                                                    <div class="text-[11px] font-medium text-slate-600 line-clamp-1 italic">
                                                                                        {{ $item->product->name }} <span
                                                                                            class="text-[9px] font-black text-slate-300">x{{ $item->quantity }}</span>
                                                                                    </div>
                                                                                @endforeach
                                                                                @if($order->items->count() > 2)
                                                                                    <div class="text-[8px] font-black text-slate-300 italic">+
                                                                                        {{ $order->items->count() - 2 }} lainnya</div>
                                                                                @endif
                                                                            </div>
                                                                        </td>
                                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                                            <span class="text-xs font-black text-primary italic">Rp
                                                                                {{ number_format($order->total_amount - $order->service_fee, 0, ',', '.') }}</span>
                                                                        </td>
                                                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                                                            <span
                                                                                class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest
                                                                                        {{ $order->status === 'completed' || $order->status === 'processing' ? 'bg-emerald-50 text-emerald-500' :
                                            ($order->status === 'pending' ? 'bg-amber-50 text-amber-500' : 'bg-slate-50 text-slate-400') }}">
                                                                                {{ $order->status }}
                                                                            </span>
                                                                        </td>
                                                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                                                            <a href="{{ route('vendor.orders.show', $order) }}"
                                                                                class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 text-white text-[9px] font-black uppercase tracking-widest rounded-xl hover:bg-primary transition-all shadow-lg active:scale-95">
                                                                                Detail
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Mobile Cards -->
                            <div class="sm:hidden divide-y divide-slate-50">
                                @foreach($recentOrders as $order)
                                                    <a href="{{ route('vendor.orders.show', $order) }}"
                                                        class="block p-5 hover:bg-slate-50 transition-colors">
                                                        <div class="flex justify-between items-start mb-3">
                                                            <div class="flex flex-col">
                                                                <span
                                                                    class="text-[10px] font-black text-primary uppercase tracking-widest mb-1">ID
                                                                    #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                                                <span class="text-sm font-black text-slate-800">{{ $order->user->name }}</span>
                                                            </div>
                                                            <span
                                                                class="px-2 py-1 rounded-lg text-[8px] font-black uppercase tracking-widest
                                                                        {{ $order->status === 'completed' || $order->status === 'processing' ? 'bg-emerald-50 text-emerald-500' :
                                    ($order->status === 'pending' ? 'bg-amber-50 text-amber-500' : 'bg-slate-50 text-slate-400') }}">
                                                                {{ $order->status }}
                                                            </span>
                                                        </div>
                                                        <div class="flex justify-between items-center">
                                                            <div class="flex flex-col">
                                                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tight italic">{{ $order->created_at->format('d M, H:i') }}</span>
                                                                <div class="flex items-center gap-2 mt-1">
                                                                    <span class="text-[10px] font-black text-primary/70 tracking-tight">{{ $order->phone ?: ($order->user->phone ?: ($order->user->addresses()->latest()->first()->phone ?? '-')) }}</span>
                                                                    @if($order->phone || $order->user->phone || $order->user->addresses()->exists())
                                                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->phone ?: ($order->user->phone ?: ($order->user->addresses()->latest()->first()->phone ?? ''))) }}" target="_blank" class="text-emerald-500 hover:text-emerald-600 transition-colors" title="WhatsApp">
                                                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <span class="text-xs font-black text-primary italic">Rp
                                                                {{ number_format($order->total_amount - $order->service_fee, 0, ',', '.') }}</span>
                                                        </div>
                                                    </a>
                                @endforeach
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

                            <div class="pt-4 border-t border-slate-50">
                                <h4 class="text-[11px] font-black text-slate-800 uppercase tracking-widest mb-4">
                                    Informasi Rekening Bank</h4>

                                <div class="space-y-4">
                                    <div>
                                        <label
                                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Nama
                                            Bank</label>
                                        <input type="text" name="bank_name" value="{{ $vendor->bank_name }}"
                                            placeholder="Contoh: BCA, Mandiri, BNI"
                                            class="w-full px-4 py-3 bg-slate-50 border-transparent rounded-xl text-slate-800 text-sm font-bold focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all">
                                    </div>

                                    <div>
                                        <label
                                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Nomor
                                            Rekening</label>
                                        <input type="text" name="bank_account_number"
                                            value="{{ $vendor->bank_account_number }}"
                                            class="w-full px-4 py-3 bg-slate-50 border-transparent rounded-xl text-slate-800 text-sm font-bold focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all">
                                    </div>

                                    <div>
                                        <label
                                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Nama
                                            Pemilik Rekening</label>
                                        <input type="text" name="bank_account_name"
                                            value="{{ $vendor->bank_account_name }}"
                                            class="w-full px-4 py-3 bg-slate-50 border-transparent rounded-xl text-slate-800 text-sm font-bold focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all">
                                    </div>
                                </div>
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