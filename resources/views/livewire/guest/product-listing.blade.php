<div class="p-4">
    <h1 class="text-3xl font-bold mb-6">Products</h1>

    <div class="flex flex-wrap gap-4 mb-6">
        <input type="text" wire:model.debounce.500ms="search" placeholder="Search products..." class="input" />

        <select wire:model="category" class="input">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->title }}</option>
            @endforeach
        </select>

        <select wire:model="brand" class="input">
            <option value="">All Brands</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->title }}</option>
            @endforeach
        </select>

        <select wire:model="sortField" class="input w-auto">
            <option value="title">Sort by Title</option>
            <option value="price">Sort by Price</option>
            <option value="category_id">Sort by Category</option>
            <option value="brand_id">Sort by Brand</option>
        </select>

        <select wire:model="sortDirection" class="input w-auto">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>
    </div>

    <div class="flex flex-wrap gap-4 mb-6">
        <div>
            <label>Price Min</label>
            <input type="number" wire:model.defer="priceMin" class="input w-24" />
        </div>
        <div>
            <label>Price Max</label>
            <input type="number" wire:model.defer="priceMax" class="input w-24" />
        </div>
    </div>

    <div class="mb-4">
        <label class="font-semibold mb-1 block">Filter by Tags:</label>
        <div class="flex flex-wrap gap-2">
            @foreach($tags as $tag)
                <label class="inline-flex items-center space-x-2">
                    <input type="checkbox" wire:model="tags" value="{{ $tag->id }}">
                    <span>{{ $tag->title }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($products as $product)
            <div class="border rounded p-4 flex flex-col">
                @if($product->images->first())
                    <img src="{{ asset('storage/' . $product->images->first()->path) }}" alt="{{ $product->title }}" class="h-48 object-cover mb-4 rounded" />
                @endif
                <h2 class="text-xl font-semibold mb-2">{{ $product->title }}</h2>
                <p class="text-gray-600 mb-2">{{ Str::limit(strip_tags($product->about), 100) }}</p>
                <p class="font-bold mb-2">Price: ${{ number_format($product->price, 2) }}</p>
                <a href="{{ route('product.show', $product->url) }}" class="mt-auto btn btn-primary text-center">View Details</a>
            </div>
        @empty
            <p>No products found.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
