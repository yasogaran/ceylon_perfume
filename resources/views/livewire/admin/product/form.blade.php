<div class="p-4 space-y-6 max-w-4xl">
    <h2 class="text-xl font-semibold">{{ $product ? 'Edit' : 'Create' }} Product</h2>

    <form wire:submit.prevent="save" class="space-y-6">

        <div>
            <label>Title</label>
            <input wire:model="title" type="text" class="input w-full">
            @error('title')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label>Slug</label>
            <input wire:model="url" type="text" class="input w-full">
            @error('url')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Price</label>
                <input wire:model="price" type="number" step="0.01" class="input w-full">
                @error('price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label>Offer Price</label>
                <input wire:model="offer_price" type="number" step="0.01" class="input w-full">
                @error('offer_price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Quantity</label>
                <input wire:model="quantity" type="number" class="input w-full">
                @error('quantity')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label>Gender</label>
                <select wire:model="gender" class="input w-full">
                    <option value="">-- Select --</option>
                    @foreach ($genders as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('gender')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Category</label>
                <select wire:model="category_id" class="input w-full">
                    <option value="">-- Select --</option>
                    @foreach ($categories as $id => $label)
                        <option value="{{ $id }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label>Brand</label>
                <select wire:model="brand_id" class="input w-full">
                    <option value="">-- Select --</option>
                    @foreach ($brands as $id => $label)
                        <option value="{{ $id }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('brand_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
            <div class="flex flex-wrap gap-3">
                @foreach (\App\Models\Tag::all() as $tag)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="tags" value="{{ $tag->id }}" class="rounded">
                        <span class="text-sm">{{ $tag->title }}</span>
                    </label>
                @endforeach
            </div>
            @error('tags')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label>Ingredients (optional)</label>
            <textarea wire:model="ingredients" rows="3" class="input w-full"></textarea>
            @error('ingredients')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label>About (HTML Description)</label>
            <textarea wire:model="about" rows="5" class="input w-full"></textarea>
            @error('about')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="keywords" class="block font-medium">SEO Keywords (comma separated)</label>
            <input type="text" id="keywords" wire:model.defer="keywords" class="input w-full" />
            @error('keywords')
                <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                {{ $product ? 'Update' : 'Create' }} Product
            </button>
        </div>
    </form>

    @if ($product && $product->id)
        <hr class="my-6">
        <livewire:admin.product.gallery :product="$product" />
    @endif

</div>
