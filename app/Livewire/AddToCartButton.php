<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class AddToCartButton extends Component
{
    public $productId;
    public $isAdded = false;
    public $variant = 'icon'; // 'icon' or 'text'

    public function mount($productId)
    {
        $this->productId = $productId;
    }

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
                'image' => $product->image,
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
        return view('livewire.add-to-cart-button');
    }
}
