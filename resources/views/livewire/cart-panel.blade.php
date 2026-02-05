<div x-data="{ isOpen: @entangle('isOpen').live }" 
     x-on:open-cart-panel.window="isOpen = true"
     x-show="isOpen" 
     x-cloak
     @keydown.escape.window="isOpen = false"
     class="fixed inset-0 z-[60] overflow-hidden">
    <div class="absolute inset-0 bg-neutral-dark/40 backdrop-blur-sm transition-opacity" @click="isOpen = false"></div>

    <div class="fixed inset-y-0 right-0 max-w-full flex">
        <div x-show="isOpen" x-transition:enter="transform transition ease-in-out duration-500"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transform transition ease-in-out duration-500" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full" class="w-screen max-w-md">
            <div class="h-full flex flex-col glass border-l shadow-2xl">
                <!-- Header -->
                <div class="p-8 border-b border-neutral-dark/5 flex items-center justify-between">
                    <h2 class="text-3xl font-black text-neutral-dark tracking-tighter">Keranjang <span
                            class="text-primary italic">Saya</span></h2>
                    <button @click="isOpen = false"
                        class="p-2 text-neutral-dark/40 hover:text-primary transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Items -->
                <div class="flex-grow overflow-y-auto p-8 space-y-6">
                    @forelse($cart as $id => $item)
                        <div class="flex gap-4 p-4 bg-white/50 rounded-3xl border border-neutral-dark/5 group">
                            <div
                                class="w-20 h-20 bg-primary/5 rounded-2xl flex items-center justify-center text-primary/20">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <h4 class="font-black text-neutral-dark tracking-tight leading-tight">{{ $item['name'] }}
                                </h4>
                                <div class="text-xs font-bold text-neutral-dark/40 mt-1 uppercase tracking-widest">
                                    {{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                                <div class="mt-2 text-lg font-black text-primary tracking-tighter">Rp
                                    {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</div>
                            </div>
                            <button wire:click="removeItem({{ $id }})"
                                class="self-start p-1 text-neutral-dark/20 hover:text-red-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    @empty
                        <div class="text-center py-20">
                            <div
                                class="w-20 h-20 bg-neutral-dark/5 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-neutral-dark/20" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <p class="text-neutral-dark/40 font-bold">Keranjang kosong.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Footer -->
                @if(count($cart) > 0)
                    <div class="p-8 border-t border-neutral-dark/5 bg-white/30 backdrop-blur-md">
                        <div class="flex justify-between items-end mb-8">
                            <div>
                                <div class="text-xs font-black text-neutral-dark/40 uppercase tracking-[0.2em] mb-1">Total
                                    Pembayaran</div>
                                <div class="text-3xl font-black text-neutral-dark tracking-tight">Rp
                                    {{ number_format($this->total, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        <a href="https://wa.me/6281234567890?text={{ $this->waMessage }}" target="_blank"
                            class="w-full h-16 bg-growth hover:bg-growth-dark text-white rounded-2xl flex items-center justify-center gap-3 text-lg font-black transition-all shadow-2xl shadow-growth/30 hover:-translate-y-1">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                            Checkout via WhatsApp
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>