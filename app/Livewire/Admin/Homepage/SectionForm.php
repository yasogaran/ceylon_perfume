<?php

namespace App\Livewire\Admin\Homepage;

use App\Models\Brand;
use App\Models\HomepageSection;
use App\Models\Category;
use App\Models\Tag;
use Livewire\Component;

class SectionForm extends Component
{
    public $sectionId;
    public $title, $category_id, $product_limit = 8, $enabled = true, $order = 0;
    public $type = 'category';
    public $brand_id;
    public $tag_id;
    public $categories;
    public $brands;
    public $tags;
    public $tag_ids;

    public function mount($id = null)
    {
        $this->brands = Brand::all();
        $this->categories = Category::all();
        $this->tags = Tag::all();
        if ($id) {
            $section = HomepageSection::findOrFail($id);
            $this->sectionId = $id;
            $this->title = $section->title;
            $this->category_id = $section->category_id;
            $this->product_limit = $section->product_limit;
            $this->enabled = $section->enabled;
            $this->order = $section->order;
            $this->tag_ids = $section->tags()->pluck('id')->toArray();
            $this->brand_id = $section->brand_id ?? null;
        } else {
            $this->enabled = true;
            $this->order = HomepageSection::max('order') + 1; // or 1 if none exists
            $this->tag_ids = [];
        }
    }

    public function save()
    {

        $this->validate();

        // Save logic here, e.g.
        HomepageSection::updateOrCreate(
            ['id' => $this->sectionId],
            [
                'title' => $this->title,
                'type' => $this->type,
                'category_id' => $this->category_id,
                'brand_id' => $this->brand_id,
                'tag_id' => $this->tag_id,
                'product_limit' => $this->product_limit,
                'order' => $this->order,
                'enabled' => $this->enabled,
            ]
        );

        session()->flash('message', 'Section saved successfully.');
        return redirect()->route('admin.homepage.sections');
    }

    public function render()
    {
        return view('livewire.admin.homepage.section-form', [
            'categories' => Category::orderBy('title')->get(),
        ])->layout('layouts.admin');
    }

    public function rules()
    {
        $rules = [
            'title' => 'nullable|string|max:255',
            'type' => 'required|in:latest,category,brand,tag,combo',
            'product_limit' => 'required|integer|min:1',
            'order' => 'required|integer|min:1',
            'enabled' => 'boolean',
        ];

        if ($this->type === 'category') {
            $rules['category_id'] = 'required|exists:categories,id';
        } elseif ($this->type === 'brand') {
            $rules['brand_id'] = 'required|exists:brands,id';
        } elseif ($this->type === 'tag') {
            $rules['tag_id'] = 'required|exists:tags,id';
        } elseif ($this->type === 'combo') {
            $rules['category_id'] = 'required|exists:categories,id';
            $rules['brand_id'] = 'required|exists:brands,id';
        }

        return $rules;
    }

    public function updatedType()
    {
        // Reset relation fields on type change
        $this->category_id = null;
        $this->brand_id = null;
        $this->tag_id = null;
    }
}
