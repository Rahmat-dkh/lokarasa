<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Wishlist;
use Livewire\Attributes\On;

class WishlistPanel extends Component
{
    public $wishlists = [];
    public $isOpen = false;

    public function mount()
    {
        $this->loadWishlists();
    }

    #[On('open-wishlist-panel')]
    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
    }

    #[On('wishlistUpdated')]
    public function loadWishlists()
    {
        if (auth()->check()) {
            $this->wishlists = auth()->user()->wishlists()->with('product')->get()->toArray();
        } else {
            $this->wishlists = [];
        }
    }

    public function removeItem($wishlistId)
    {
        $wishlist = Wishlist::find($wishlistId);

        if ($wishlist && $wishlist->user_id === auth()->id()) {
            $wishlist->delete();
            $this->dispatch('wishlistUpdated');
        }
    }

    public function render()
    {
        return view('livewire.wishlist-panel');
    }
}
