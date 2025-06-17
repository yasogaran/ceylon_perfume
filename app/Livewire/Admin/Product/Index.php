<?php
namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        session()->flash('message', 'Product deleted successfully.');
    }

    public function render()
    {
        $products = Product::with('category', 'brand')
            ->when($this->search, fn($query) =>
                $query->where('title', 'like', '%' . $this->search . '%')
            )
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.product.index', compact('products'))
            ->layout('layouts.admin');
    }
}
