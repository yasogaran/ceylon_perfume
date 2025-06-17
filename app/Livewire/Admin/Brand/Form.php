<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;

class Form extends Component
{

    public $brandId;
    public $title;

    public function mount($brand = null)
    {
        $this->brandId = $brand;

        if ($brand) {
            $model = Brand::findOrFail($brand);
            $this->title = $model->title;
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
        ]);

        Brand::updateOrCreate(
            ['id' => $this->brandId],
            ['title' => $this->title]
        );

        return redirect()->route('admin.brands.index');
    }

    public function render()
    {
        return view('livewire.admin.brand.form')->layout('layouts.admin');
    }
}
