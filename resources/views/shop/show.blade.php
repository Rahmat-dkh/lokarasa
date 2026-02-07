<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $vendor->shop_name }}
        </h2>
    </x-slot>

    <!-- Shop Header / Banner Area -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
            <div class="flex flex-col md:flex-row items-center gap-6 md:gap-10">
                <!-- Shop Logo -->
                <div class="flex-shrink-0">
                    @if($vendor->logo)
                        <img class="h-24 w-24 md:h-32 md:w-32 rounded-full object-cover border-4 border-slate-50 shadow-lg"
                            src="{{ asset('storage/' . $vendor->logo) }}" alt="{{ $vendor->shop_name }}">
                    @else
                        <div
                            class="h-24 w-24 md:h-32 md:w-32 rounded-full bg-gradient-to-br from-primary to-blue-600 flex items-center justify-center text-white text-3xl md:text-4xl font-black shadow-lg">
                            {{ substr($vendor->shop_name, 0, 1) }}
                        </div>
                    @endif
                </div>

                <!-- Shop Info -->
                <div class="text-center md:text-left flex-grow">
                    <h1 class="text-2xl md:text-4xl font-black text-slate-800 tracking-tight mb-2">
                        {{ $vendor->shop_name }}
                    </h1>
                    <p class="text-slate-500 text-sm md:text-base max-w-2xl mx-auto md:mx-0 mb-4 leading-relaxed">
                        {{ $vendor->description ?? 'Selamat datang di toko kami! Temukan produk UMKM terbaik di sini.' }}
                    </p>

                    <div class="flex flex-wrap justify-center md:justify-start gap-3">
                        <div
                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-bold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            {{ $products->total() }} Produk
                        </div>
                        <div
                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-bold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Bergabung {{ $vendor->created_at->diffForHumans() }}
                        </div>
                    </div>

                    @auth
                        @if(Auth::user()->id === $vendor->user_id)
                            <div
                                class="mt-6 p-4 bg-primary/5 border border-primary/10 rounded-2xl flex flex-wrap gap-3 justify-center md:justify-start">
                                <p
                                    class="w-full text-[10px] font-black text-primary uppercase tracking-widest mb-1 text-center md:text-left">
                                    Panel Pemilik Toko</p>
                                <a href="{{ route('vendor.dashboard') }}"
                                    class="px-4 py-2 bg-primary text-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-md hover:bg-primary-dark transition-all">
                                    Dashboard
                                </a>
                                <a href="{{ route('vendor.products.create') }}"
                                    class="px-4 py-2 bg-white text-slate-700 text-[10px] font-black uppercase tracking-widest rounded-xl border border-slate-200 hover:bg-slate-50 transition-all">
                                    + Produk
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="w-1 h-6 bg-primary rounded-full"></span>
                Produk Terbaru
            </h3>

            @if($products->isEmpty())
                <div class="text-center py-16 bg-white rounded-3xl shadow-sm border border-slate-100">
                    <div class="bg-slate-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <p class="text-slate-500 font-medium">Belum ada produk yang ditampilkan.</p>
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                    @foreach($products as $product)
                        <div
                            class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                            <a href="{{ route('products.show', $product) }}"
                                class="block relative aspect-square overflow-hidden bg-slate-100">
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
                                    <img src="{{ $src }}" alt="{{ $product->name }}"
                                        class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-2 right-2">
                                    <button
                                        class="w-8 h-8 rounded-full bg-white/90 backdrop-blur text-slate-400 hover:text-red-500 flex items-center justify-center shadow-sm transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </a>

                            <div class="p-4">
                                <div class="mb-2">
                                    <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider mb-1">
                                        {{ $product->category->name }}
                                    </p>
                                    <h3
                                        class="font-bold text-slate-900 leading-tight line-clamp-2 group-hover:text-primary transition-colors">
                                        <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                    </h3>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="font-black text-lg text-primary">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <div class="text-[10px] text-slate-500 font-medium">Terjual 0</div>
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