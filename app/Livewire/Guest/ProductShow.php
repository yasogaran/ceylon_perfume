<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use App\Models\Product;

class ProductShow extends Component
{
    public $slug;
    public $product;

    public function mount($slug)
    {
        $this->product = Product::with(['category', 'brand', 'tags', 'images'])->where('url', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.guest.product-show')->layout('layouts.guest');
    }
}
