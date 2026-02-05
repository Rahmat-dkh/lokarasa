<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Wishlist;

class WishlistButton extends Component
{
    public $productId;
    public $isInWishlist = false;

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->checkWishlist();
    }

    public function checkWishlist()
    {
        if (auth()->check()) {
            $this->isInWishlist = Wishlist::where('user_id', auth()->id())
                ->where('product_id', $this->productId)
                ->exists();
        }
    }

    public function toggle()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if ($this->isInWishlist) {
            // Remove from wishlist
            Wishlist::where('user_id', auth()->id())
                ->where('product_id', $this->productId)
                ->delete();
            $this->isInWishlist = false;
        } else {
            // Add to wishlist
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $this->productId,
            ]);
            $this->isInWishlist = true;
        }

        $this->dispatch('wishlistUpdated');
    }

    public function render()
    {
        return view('livewire.wishlist-button');
    }
}
