<?php
namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Form extends Component
{
    public $categoryId;
    public $title;

    public function mount($category = null)
    {
        $this->categoryId = $category;

        if ($category) {
            $model = Category::findOrFail($category);
            $this->title = $model->title;
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
        ]);

        Category::updateOrCreate(
            ['id' => $this->categoryId],
            ['title' => $this->title]
        );

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.admin.category.form')->layout('layouts.admin');
    }
}
