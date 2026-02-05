<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Wishlist;

class WishlistPanel extends Component
{
    public $wishlists = [];
    public $isOpen = false;

    protected $listeners = ['open-wishlist-panel' => 'open', 'wishlistUpdated' => 'loadWishlists'];

    public function mount()
    {
        $this->loadWishlists();
    }

    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
    }

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
