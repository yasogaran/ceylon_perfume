<div class="p-6 max-w-xl mx-auto">
    <h2 class="text-xl font-bold mb-4">
        <h2 class="text-xl font-bold mb-4">
            {{ $categoryId ? 'Edit' : 'Create' }} Category
        </h2>
    </h2>

    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block font-medium">Title</label>
            <input type="text" wire:model="title" class="w-full border rounded px-3 py-2">
            @error('title')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                Save
            </button>
            <a href="{{ route('admin.categories.index') }}" class="ml-2 text-gray-600 underline">Cancel</a>
        </div>
    </form>
</div>
