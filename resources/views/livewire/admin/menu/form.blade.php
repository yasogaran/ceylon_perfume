<div class="p-4 max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">{{ $menuId ? 'Edit Menu' : 'Create Menu' }}</h1>

    <form wire:submit.prevent="save" class="space-y-4">

        <div>
            <label class="block font-medium mb-1">Title</label>
            <input type="text" wire:model.defer="title" class="input w-full" />
            @error('title')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">URL</label>
            <input type="text" wire:model.defer="url" placeholder="/example-url" class="input w-full" />
            @error('url')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Description</label>
            <textarea wire:model.defer="description" class="input w-full" rows="3"></textarea>
            @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Keywords (comma-separated)</label>
            <input type="text" wire:model.defer="keywords" class="input w-full" />
            @error('keywords')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Order</label>
            <input type="number" wire:model.defer="order" class="input w-full" min="0" />
            @error('order')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Category</label>
            <select wire:model.defer="category_id" class="input w-full">
                <option value="">-- Select Category --</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Brand</label>
            <select wire:model.defer="brand_id" class="input w-full">
                <option value="">-- Select Brand --</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                @endforeach
            </select>
            @error('brand_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Tags</label>
            <select wire:model="tag_ids" multiple class="input w-full" size="5">
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                @endforeach
            </select>
            @error('tag_ids')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Parent Menu</label>
            <select wire:model.defer="parent_id" class="input w-full">
                <option value="">-- None --</option>
                @foreach ($menus as $menuOption)
                    @if ($menuId !== $menuOption->id)
                        {{-- prevent selecting itself --}}
                        <option value="{{ $menuOption->id }}">{{ $menuOption->title }}</option>
                    @endif
                @endforeach
            </select>
            @error('parent_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center space-x-2">
            <input type="checkbox" wire:model.defer="enabled" id="enabled" />
            <label for="enabled" class="font-medium">Enabled</label>
        </div>

        <div>
            <button class="btn btn-primary">{{ $menuId ? 'Update' : 'Create' }} Menu</button>
        </div>

    </form>
</div>
