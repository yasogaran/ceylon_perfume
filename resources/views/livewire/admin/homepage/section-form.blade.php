<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">{{ $sectionId ? 'Edit' : 'Create' }} Homepage Section</h1>

    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block font-medium">Title (optional)</label>
            <input type="text" wire:model.defer="title" class="input w-full" />
        </div>

        <div>
            <label>Type</label>
            <select wire:model.lazy="type" class="input w-full">
                <option value="latest">Latest Products</option>
                <option value="category">Category</option>
                <option value="brand">Brand</option>
                <option value="tag">Tag</option>
                <option value="combo">Category + Brand</option>
            </select>
        </div>

        @if (in_array($type, ['category', 'combo']))
            <div>
                <label>Category</label>
                <select wire:model="category_id" class="input w-full">
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        @if (in_array($type, ['brand', 'combo']))
            <div>
                <label>Brand</label>
                <select wire:model="brand_id" class="input w-full">
                    <option value="">-- Select Brand --</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        @if ($type === 'tag')
            <div>
                <label>Tag</label>
                <select wire:model="tag_id" class="input w-full">
                    <option value="">-- Select Tag --</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div>
            <label class="block font-medium">Product Limit</label>
            <input type="number" wire:model.defer="product_limit" class="input w-full" />
        </div>

        <div>
            <label class="block font-medium">Order</label>
            <input type="number" wire:model.defer="order" class="input w-full" />
        </div>

        <div class="flex items-center">
            <input type="checkbox" wire:model.defer="enabled" class="mr-2" /> <span>Enabled</span>
        </div>

        <div>
            <button class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
