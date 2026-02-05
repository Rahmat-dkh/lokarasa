<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class CartPanel extends Component
{
    public $cart = [];
    public $isOpen = false;

    protected $listeners = ['cartUpdated' => 'loadCart', 'open-cart-panel' => 'open'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cart = Session::get('cart', []);
    }

    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
    }

    public function removeItem($id)
    {
        unset($this->cart[$id]);
        Session::put('cart', $this->cart);
        $this->dispatch('cartUpdated');
    }

    public function getTotalProperty()
    {
        return array_reduce($this->cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    }

    public function getWaMessageProperty()
    {
        $text = "Halo LocalGo Commerce, saya ingin memesan:\n\n";
        foreach ($this->cart as $item) {
            $text .= "- " . $item['name'] . " (" . $item['quantity'] . "x) - Rp " . number_format($item['price'], 0, ',', '.') . "\n";
        }
        $text .= "\nTotal: Rp " . number_format($this->total, 0, ',', '.') . "\n\nTerima kasih!";
        return urlencode($text);
    }

    public function render()
    {
        return view('livewire.cart-panel');
    }
}
