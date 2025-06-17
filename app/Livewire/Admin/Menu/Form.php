<?php

namespace App\Livewire\Admin\Menu;

use App\Models\Menu;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Tag;
use Livewire\Component;

class Form extends Component
{
    public $menuId;
    public $title;
    public $url;
    public $description;
    public $keywords;
    public $order = 0;
    public $category_id;
    public $brand_id;
    public $enabled = true;
    public $parent_id;
    public $tag_ids = [];

    public $categories;
    public $brands;
    public $tags;
    public $menus; // for parent menu select

    public function mount($id = null)
    {
        $this->categories = Category::all();
        $this->brands = Brand::all();
        $this->tags = Tag::all();
        $this->menus = Menu::all();

        if ($id) {
            $menu = Menu::findOrFail($id);
            $this->menuId = $menu->id;
            $this->title = $menu->title;
            $this->url = $menu->url;
            $this->description = $menu->description;
            $this->keywords = $menu->keywords;
            $this->order = $menu->order;
            $this->category_id = $menu->category_id;
            $this->brand_id = $menu->brand_id;
            $this->enabled = $menu->enabled;
            $this->parent_id = $menu->parent_id;
            $this->tag_ids = $menu->tags()->pluck('id')->toArray();
        }
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255|unique:menus,url,' . $this->menuId,
            'description' => 'nullable|string',
            'keywords' => 'nullable|string|max:255',
            'order' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'enabled' => 'boolean',
            'parent_id' => 'nullable|exists:menus,id|not_in:' . $this->menuId,
            'tag_ids.*' => 'exists:tags,id',
        ];
    }

    public function save()
    {
        $this->validate();

        $menu = Menu::updateOrCreate(
            ['id' => $this->menuId],
            [
                'title' => $this->title,
                'url' => $this->url,
                'description' => $this->description,
                'keywords' => $this->keywords,
                'order' => $this->order,
                'category_id' => $this->category_id,
                'brand_id' => $this->brand_id,
                'enabled' => $this->enabled,
                'parent_id' => $this->parent_id,
            ]
        );

        $menu->tags()->sync($this->tag_ids);

        session()->flash('message', 'Menu saved successfully.');

        return redirect()->route('admin.menus.index');
    }

    public function render()
    {
        return view('livewire.admin.menu.form')->layout('layouts.admin');
    }
}
