<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Tag;

class ProductListing extends Component
{
    use WithPagination;

    public $search = '';
    public $category = null;
    public $brand = null;
    public $tags = [];
    public $priceMin = null;
    public $priceMax = null;
    public $sortField = 'title'; // Default sort by title
    public $sortDirection = 'asc'; // Default ascending

    protected $queryString = ['search', 'category', 'brand', 'tags', 'priceMin', 'priceMax', 'sortField', 'sortDirection'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingBrand()
    {
        $this->resetPage();
    }

    public function updatingTags()
    {
        $this->resetPage();
    }

    public function updatingPriceMin()
    {
        $this->resetPage();
    }

    public function updatingPriceMax()
    {
        $this->resetPage();
    }

    public function updatingSortField()
    {
        $this->resetPage();
    }

    public function updatingSortDirection()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::query()->with(['category', 'brand', 'tags', 'images'])
            ->where('enabled', true);

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        if ($this->category) {
            $query->where('category_id', $this->category);
        }

        if ($this->brand) {
            $query->where('brand_id', $this->brand);
        }

        if (!empty($this->tags)) {
            $query->whereHas('tags', function ($q) {
                $q->whereIn('id', $this->tags);
            });
        }

        if ($this->priceMin !== null) {
            $query->where('price', '>=', $this->priceMin);
        }

        if ($this->priceMax !== null) {
            $query->where('price', '<=', $this->priceMax);
        }

        if (in_array($this->sortField, ['price', 'title', 'category_id', 'brand_id'])) {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        $products = $query->paginate(12);

        $categories = Category::all();
        $brands = Brand::all();
        $tags = Tag::all();

        return view('livewire.guest.product-listing', compact('products', 'categories', 'brands', 'tags'))->layout('layouts.guest');
    }
}
