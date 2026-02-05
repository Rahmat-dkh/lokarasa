<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class AddToCartButton extends Component
{
    public $productId;
    public $isAdded = false;

    public function addToCart()
    {
        $product = Product::findOrFail($this->productId);
        $cart = Session::get('cart', []);

        if (isset($cart[$this->productId])) {
            $cart[$this->productId]['quantity']++;
        } else {
            $cart[$this->productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        Session::put('cart', $cart);
        $this->isAdded = true;

        $this->dispatch('cartUpdated');

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => $product->name . ' ditambahkan ke keranjang!'
        ]);
    }

    public function render()
    {
        return <<<'HTML'
        <button wire:click="addToCart" 
                class="w-14 h-14 bg-innovation text-white rounded-2xl flex items-center justify-center transition-all duration-300 shadow-lg shadow-innovation/30 hover:bg-innovation-dark hover:scale-110 active:scale-95 group/btn">
            @if($isAdded)
                <svg class="w-6 h-6 animate-ping" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            @else
                <svg class="w-6 h-6 transition-transform group-hover/btn:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                </svg>
            @endif
        </button>
        HTML;
    }
}
