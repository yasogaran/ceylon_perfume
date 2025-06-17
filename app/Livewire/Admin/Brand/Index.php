<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public function delete($id)
    {
        Brand::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.admin.brand.index', [
            'brands' => Brand::latest()->paginate(10),
        ])->layout('layouts.admin');
    }
}
