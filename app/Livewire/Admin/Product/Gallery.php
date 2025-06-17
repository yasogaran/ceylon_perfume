<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Gallery extends Component
{
    use WithFileUploads;

    public Product $product;
    public $images = [];

    public function updatedImages()
    {
        $this->validate([
            'images.*' => 'image|max:2048', // 2MB limit
        ]);
    }

    public function save()
    {
        foreach ($this->images as $image) {
            $path = $image->store('product-images', 'public');

            $this->product->images()->create([
                'image_path' => $path,
            ]);
        }

        $this->reset('images');
    }

    public function delete($id)
    {
        $image = ProductGallery::findOrFail($id);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
    }

    public function render()
    {
        return view('livewire.admin.product.gallery', [
            'gallery' => $this->product->images,
        ]);
    }
}
