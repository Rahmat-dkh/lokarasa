@props(['product'])

<div
    class="group relative flex flex-col h-full bg-white border border-slate-300 shadow-md rounded-2xl md:rounded-[2rem] p-2 md:p-3 hover:border-primary hover:shadow-xl hover:shadow-primary/20 transition-all duration-500 hover:-translate-y-1">
    <!-- Main Stretched Link -->
    <a href="{{ route('products.show', $product->id) }}" class="absolute inset-0 z-10"
        aria-label="{{ $product->name }}"></a>

    <!-- Image Area -->
    <div
        class="relative aspect-square rounded-xl md:rounded-[1.5rem] overflow-hidden bg-slate-50 transition-all duration-700 group-hover:bg-primary/5">
        <!-- Floating Tag -->
        <div class="absolute top-2 left-2 md:top-3 md:left-3 z-20">
            <span
                class="bg-white/90 backdrop-blur-md px-1.5 py-0.5 md:px-2 md:py-1 text-[8px] md:text-[9px] font-black uppercase tracking-wider text-primary rounded-lg shadow-sm">
                {{ $product->category->name }}
            </span>
        </div>

        <!-- Wishlist Button -->
        <div class="absolute top-2 right-2 md:top-3 md:right-3 z-30">
            <livewire:wishlist-button :product-id="$product->id" :key="'wishlist-' . $product->id" />
        </div>

        <!-- Product Image or Placeholder -->
        <div
            class="h-full w-full flex items-center justify-center transition-transform duration-700 group-hover:scale-110">
            @if($product->image_url)
                <img src="{{ Str::startsWith($product->image_url, 'http') ? $product->image_url : $product->image_url }}"
                    alt="{{ $product->name }}" class="w-full h-full object-cover">
            @else
                <div class="text-primary/10">
                    <svg class="w-16 h-16 md:w-20 md:h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            @endif
        </div>
    </div>

    <!-- Content Area -->
    <div class="mt-2 md:mt-3 px-1">
        <!-- Tags & Rating -->
        <div class="flex items-center justify-between mb-1.5 md:mb-2">
            <span
                class="px-1.5 py-0.5 md:px-2 md:py-0.5 bg-primary/10 text-primary text-[8px] md:text-[9px] font-black uppercase rounded-md">
                UMKM
            </span>
            @if($product->reviews_avg_rating > 0)
                <div class="flex items-center gap-1 md:gap-1.5">
                    <svg class="w-3.5 h-3.5 md:w-4 md:h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <span class="text-[10px] md:text-xs font-bold text-slate-500">
                        {{ number_format($product->reviews_avg_rating, 1) }}
                    </span>
                </div>
            @endif
        </div>

        <!-- Name -->
        <h3
            class="text-xs md:text-sm font-bold text-slate-800 tracking-tight leading-snug group-hover:text-primary transition-colors line-clamp-2 min-h-[2.5em] mb-1">
            {{ $product->name }}
        </h3>

        <!-- Price & Action -->
        <div class="mt-1.5 md:mt-2 flex items-center justify-between">
            <div class="flex flex-col">
                <span class="text-sm md:text-lg font-black text-slate-900 tracking-tighter">
                    <span
                        class="text-[10px] md:text-xs font-bold text-primary mr-0.5">Rp</span>{{ number_format($product->price, 0, ',', '.') }}
                </span>
            </div>

            <div class="relative z-30 transform scale-90 md:scale-100 origin-right">
                <livewire:add-to-cart-button :product-id="$product->id" :key="'add-btn-' . $product->id" />
            </div>
        </div>
    </div>
</div>