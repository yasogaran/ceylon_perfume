<div class="p-4 space-y-4">
    <h2 class="text-lg font-semibold">Product Gallery</h2>

    <form wire:submit.prevent="save" class="space-y-2">
        <input type="file" wire:model="images" multiple class="input w-full">
        @error('images.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
            Upload
        </button>
    </form>

    <div class="grid grid-cols-4 gap-4 mt-4">
        @foreach ($gallery as $image)
            <div class="relative group">
                <img src="{{ asset('storage/' . $image->image_path) }}" class="rounded shadow w-full h-32 object-cover">
                <button wire:click="delete({{ $image->id }})"
                        class="absolute top-1 right-1 bg-red-500 text-black text-xs rounded px-1 py-0.5 hidden group-hover:block">
                    Delete
                </button>
            </div>
        @endforeach
    </div>
</div>
