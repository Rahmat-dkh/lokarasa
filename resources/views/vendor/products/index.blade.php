<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-black text-2xl text-slate-800 leading-tight tracking-tight">
                {{ __('Katalog Produk Saya') }}
            </h2>
            <a href="{{ route('vendor.products.create') }}"
                class="hidden sm:inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-black py-3 px-6 rounded-2xl transition-all shadow-xl shadow-primary/20 text-xs uppercase tracking-widest active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Produk Baru
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Mobile Add Button (FAB) -->
            <a href="{{ route('vendor.products.create') }}"
                class="sm:hidden fixed bottom-6 right-6 w-16 h-16 bg-primary text-white rounded-full shadow-2xl flex items-center justify-center z-50 hover:scale-110 transition-transform active:scale-95 border-4 border-white">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                </svg>
            </a>

            @if($products->isEmpty())
                <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 p-12 sm:p-20 text-center max-w-2xl mx-auto mt-10">
                    <div class="bg-primary/5 w-24 h-24 rounded-[2rem] flex items-center justify-center mx-auto mb-6 transform -rotate-12">
                        <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-2">Belum ada produk</h3>
                    <p class="text-slate-500 font-medium mb-8">Etalase toko Anda masih kosong. Ayo buat produk pertama Anda sekarang!</p>
                    <a href="{{ route('vendor.products.create') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-primary text-white rounded-[1.5rem] font-black text-xs uppercase tracking-widest hover:bg-primary-dark transition-all shadow-xl shadow-primary/20">
                        Buat Produk Pertama
                    </a>
                </div>
            @else
                <!-- Desktop Table View -->
                <div class="hidden lg:block bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Produk</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Kategori</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Harga & Stok</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($products as $product)
                                <tr class="group hover:bg-slate-50/50 transition-colors">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-5">
                                            <div class="h-16 w-16 flex-shrink-0 rounded-2xl overflow-hidden border-2 border-slate-100 bg-slate-50 relative group-hover:border-primary/20 transition-colors">
                                                @php
                                                    $imagePath = $product->image;
                                                    $src = '';
                                                    if ($imagePath) {
                                                        if (str_starts_with($imagePath, 'http')) {
                                                            $src = $imagePath;
                                                        } elseif (str_starts_with($imagePath, 'products/')) {
                                                            $src = asset('storage/' . $imagePath);
                                                        } else {
                                                            $src = asset('images/' . $imagePath);
                                                        }
                                                    }
                                                @endphp
                                                @if($src)
                                                    <img class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ $src }}" alt="">
                                                @else
                                                    <div class="h-full w-full flex items-center justify-center text-slate-300">
                                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-sm font-black text-slate-800 group-hover:text-primary transition-colors">{{ $product->name }}</div>
                                                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-tight mt-0.5">ID: #{{ $product->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-blue-50 text-blue-500">
                                            {{ $product->category->name ?? 'Tanpa Kategori' }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="text-sm font-black text-slate-700">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                        <div class="text-[10px] font-bold text-slate-400 mt-0.5">Tersedia: <span class="{{ $product->stock <= 5 ? 'text-amber-500 font-black' : '' }}">{{ $product->stock }} Item</span></div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <a href="{{ route('vendor.products.edit', $product) }}"
                                                class="w-10 h-10 flex items-center justify-center text-blue-500 bg-blue-50 hover:bg-blue-500 hover:text-white rounded-xl transition-all shadow-sm" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </a>
                                            <form action="{{ route('vendor.products.destroy', $product) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-10 h-10 flex items-center justify-center text-red-500 bg-red-50 hover:bg-red-500 hover:text-white rounded-xl transition-all shadow-sm" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Touch Device Layout (Cards) -->
                <div class="lg:hidden grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($products as $product)
                        <div class="bg-white rounded-[2rem] p-5 shadow-sm border border-slate-100 relative group">
                            <div class="flex gap-5 mb-5">
                                <div class="h-20 w-20 flex-shrink-0 rounded-2xl overflow-hidden border border-slate-100 bg-slate-50">
                                    @php
                                        $imagePath = $product->image;
                                        $src = '';
                                        if ($imagePath) {
                                            if (str_starts_with($imagePath, 'http')) {
                                                $src = $imagePath;
                                            } elseif (str_starts_with($imagePath, 'products/')) {
                                                $src = asset('storage/' . $imagePath);
                                            } else {
                                                $src = asset('images/' . $imagePath);
                                            }
                                        }
                                    @endphp
                                    @if($src)
                                        <img class="h-full w-full object-cover" src="{{ $src }}" alt="">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center text-slate-300">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <div class="text-[10px] font-black text-primary uppercase tracking-widest mb-1">{{ $product->category->name ?? 'Uncategorized' }}</div>
                                    <h3 class="font-black text-slate-800 truncate">{{ $product->name }}</h3>
                                    <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase">Stok: {{ $product->stock }} Item</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                                <div class="text-lg font-black text-slate-800">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('vendor.products.edit', $product) }}" class="w-10 h-10 flex items-center justify-center bg-blue-50 text-blue-500 rounded-xl active:scale-90 transition-transform">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    <form action="{{ route('vendor.products.destroy', $product) }}" method="POST"
                                        onsubmit="return confirm('Hapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-10 h-10 flex items-center justify-center bg-red-50 text-red-500 rounded-xl active:scale-90 transition-transform">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>