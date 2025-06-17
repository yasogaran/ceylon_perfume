<div class="p-4 space-y-4 max-w-xl">
    <h2 class="text-lg font-semibold">{{ $tag ? 'Edit Tag' : 'Create Tag' }}</h2>

    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block text-sm">Title</label>
            <input type="text" wire:model="title" class="input w-full">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm">Type</label>
            <input type="text" wire:model="type" class="input w-full" placeholder="e.g., offer, new">
            @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button class="bg-blue-600 text-white px-3 py-1 rounded">Save</button>
    </form>
</div>
