<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use App\Models\Product;

class ProductShow extends Component
{
    public $slug;
    public $product;
    public $addedToCart = false;

    public function addToCart($productId)
    {
        // Emit event to cart component to add the product
        $this->emitTo('cart', 'addProduct', $productId);

        // Set flag to true to update button text
        $this->addedToCart = true;

        // Optionally, reset after a delay (if you want button text to revert)
        $this->dispatchBrowserEvent('cart-added', ['productId' => $productId]);
    }
    protected $listeners = ['resetAddedToCart' => 'resetAddedToCart'];

    public function resetAddedToCart()
    {
        $this->addedToCart = false;
    }
    
    public function mount($slug)
    {
        $this->product = Product::with(['category', 'brand', 'tags', 'images'])->where('url', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.guest.product-show')->layout('layouts.guest');
    }
}
