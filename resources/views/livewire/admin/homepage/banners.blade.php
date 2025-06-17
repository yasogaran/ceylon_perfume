<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Homepage Banners</h1>

    <form wire:submit.prevent="save" class="mb-6">
        <input type="file" wire:model="bannerImage" class="mb-2" />
        @error('bannerImage')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
        <button class="btn btn-primary">Upload</button>
    </form>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ($banners as $banner)
            <div class="relative">
                <img src="{{ asset('storage/' . $banner->image_path) }}" class="w-full h-32 object-cover rounded">
                <button wire:click="delete({{ $banner->id }})" class="absolute top-1 right-1 text-red-600">✖</button>
            </div>
        @endforeach
    </div>
</div>
