<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Enums\GenderEnum;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Str;

class Form extends Component
{
    public ?Product $product = null;

    public $title, $url, $price, $offer_price, $quantity, $gender, $about, $ingredients, $keywords;
    public $category_id, $brand_id, $tags = [];

    public function mount($product = null)
    {
        $this->product = $product;

        if ($product) {
            $this->fill($product->only([
                'title',
                'url',
                'price',
                'offer_price',
                'quantity',
                'gender',
                'ingredients',
                'category_id',
                'brand_id',
                'keywords',
            ]));

            if ($this->product && $this->product->id) {
                $this->tags = $this->product->tags()->pluck('tags.id')->toArray();
            }
            $this->about = optional($product->description)->html_content;
        }
    }

    public function updatedTitle()
    {
        if (! $this->url) {
            $this->url = Str::url($this->title);
        }
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'url' => ['required', 'string', 'max:255', Rule::unique('products', 'url')->ignore($this->product?->id)],
            'price' => 'required|numeric|min:0',
            'offer_price' => 'nullable|numeric|min:0|lt:price',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'gender' => ['required', Rule::in(array_column(GenderEnum::cases(), 'value'))],
            'about' => 'required|string',
            'ingredients' => 'nullable|string',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'keywords' => 'nullable|string',
        ];
    }

    public function save()
    {
        $this->validate();

        $product = Product::updateOrCreate(
            ['id' => $this->product?->id],
            [
                'title' => $this->title,
                'url' => $this->url,
                'price' => $this->price,
                'offer_price' => $this->offer_price,
                'quantity' => $this->quantity,
                'gender' => $this->gender,
                'category_id' => $this->category_id,
                'brand_id' => $this->brand_id,
                'ingredients' => $this->ingredients,
                'keywords' => $this->keywords,
            ]
        );

        $product->description()->updateOrCreate([], ['html_content' => $this->about]);
        $product->tags()->sync($this->tags);

        $this->product = $product;

        session()->flash('message', 'Product saved successfully.');
    }


    public function render()
    {
        return view('livewire.admin.product.form', [
            'categories' => Category::pluck('title', 'id'),
            'brands' => Brand::pluck('title', 'id'),
            'genders' => GenderEnum::labels(),
        ])->layout('layouts.admin');
    }
}
