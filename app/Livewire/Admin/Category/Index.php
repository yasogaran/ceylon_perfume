<?php
namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.admin.category.index', [
            'categories' => Category::latest()->paginate(10),
        ])->layout('layouts.admin');
    }
}
