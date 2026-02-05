<?php

namespace App\Livewire;

use Livewire\Component;

class WishlistIcon extends Component
{
    public $count = 0;

    protected $listeners = ['wishlistUpdated' => 'loadCount'];

    public function mount()
    {
        $this->loadCount();
    }

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
