<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class WishlistIcon extends Component
{
    public $count = 0;

    public function mount()
    {
        $this->loadCount();
    }

    #[On('wishlistUpdated')]
    public function loadCount()
    {
        $this->count = auth()->check()
            ? auth()->user()->wishlists()->count()
            : 0;
    }

    public function render()
    {
        return view('livewire.wishlist-icon');
    }
}
