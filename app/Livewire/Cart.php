<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $items = [];

    public function mount()
    {
        $this->items = session('cart', []);
    }

    public function addProduct($productId)
    {
        $cart = session('cart', []);
        dd('cart received');
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
        } else {
            $cart[$productId] = ['quantity' => 1];
        }

        session(['cart' => $cart]);
        $this->items = $cart;
        $this->emit('cartUpdated');
    }

    public function removeProduct($productId)
    {
        $cart = session('cart', []);
        unset($cart[$productId]);
        session(['cart' => $cart]);
        $this->items = $cart;
        $this->emit('cartUpdated');
    }

    public function updateQuantity($productId, $quantity)
    {
        $cart = session('cart', []);
        if ($quantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId]['quantity'] = $quantity;
        }
        session(['cart' => $cart]);
        $this->items = $cart;
        $this->emit('cartUpdated');
    }

    public function render()
    {
        // Load product details for items in cart
        $productIds = array_keys($this->items);
        $products = \App\Models\Product::whereIn('id', $productIds)->get();

        return view('livewire.cart', [
            'products' => $products,
        ]);
    }
}
