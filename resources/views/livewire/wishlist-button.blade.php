<button wire:click="toggle"
    class="absolute top-4 right-4 w-10 h-10 rounded-full {{ $isInWishlist ? 'bg-red-500' : 'bg-white/90 backdrop-blur' }} flex items-center justify-center shadow-lg hover:scale-110 transition-all {{ $isInWishlist ? 'hover:bg-red-600' : 'hover:bg-white' }} group z-10">
    <svg class="w-5 h-5 {{ $isInWishlist ? 'text-white' : 'text-slate-400 group-hover:text-red-500' }} transition-colors"
        fill="{{ $isInWishlist ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
        </path>
    </svg>
</button>