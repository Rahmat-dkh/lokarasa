<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;

class CartCounter extends Component
{
    public $count = 0;

    public function mount()
    {
        $this->updateCount();
    }

    #[On('cartUpdated')]
    public function updateCount()
    {
        $cart = Session::get('cart', []);
        $this->count = array_sum(array_column($cart, 'quantity'));
    }

    public function render()
    {
        return view('livewire.cart-counter');
    }
}
