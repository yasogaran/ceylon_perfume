<div class="p-6 max-w-5xl mx-auto" x-data="{ mainImage: '{{ asset('storage/' . ($product->images->first()->image_path ?? 'default.jpg')) }}' }">
    <div class="flex flex-col md:flex-row gap-6">
        {{-- Product Images Gallery --}}
        <div class="md:w-1/2">
            <img :src="mainImage" alt="{{ $product->title }}" class="w-full h-96 object-cover rounded mb-4" />

            @if ($product->images->count() > 1)
                <div class="flex space-x-2 overflow-x-auto">
                    @foreach ($product->images as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->title }}"
                            class="h-20 w-20 object-cover rounded cursor-pointer border border-gray-300 hover:border-blue-500"
                            @click="mainImage = '{{ asset('storage/' . $image->image_path) }}'" />
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Product Details --}}
        <div class="md:w-1/2 flex flex-col">
            <h1 class="text-4xl font-bold mb-2">{{ $product->title }}</h1>

            <div class="mb-4">
                <span class="text-lg font-semibold text-green-600">${{ number_format($product->price, 2) }}</span>
                @if ($product->discount_price && $product->discount_price < $product->price)
                    <span class="line-through text-gray-500 ml-2">${{ number_format($product->price, 2) }}</span>
                @endif
            </div>

            <div class="mb-4">
                <strong>Category:</strong>
                <a href="{{ route('products.index', ['category' => $product->category_id]) }}"
                    class="text-blue-600 hover:underline">
                    {{ $product->category->title ?? 'N/A' }}
                </a>
            </div>

            <div class="mb-4">
                <strong>Brand:</strong>
                <a href="{{ route('products.index', ['brand' => $product->brand_id]) }}"
                    class="text-blue-600 hover:underline">
                    {{ $product->brand->title ?? 'N/A' }}
                </a>
            </div>

            <div class="mb-4">
                <strong>Tags:</strong>
                @foreach ($product->tags as $tag)
                    <span class="inline-block bg-gray-200 rounded px-2 py-1 text-sm mr-2">{{ $tag->title }}</span>
                @endforeach
            </div>

            <div class="mb-6 text-gray-700">
                {!! nl2br(e($product->about)) !!}
            </div>

            <div>
                <button wire:click="addToCart({{ $product->id }})" class="btn btn-primary"
                    wire:loading.attr="disabled">
                    @if ($addedToCart)
                        Added to Cart ✓
                    @else
                        Add to Cart
                    @endif
                </button>

            </div>
        </div>
    </div>

    @livewire('cart')
</div>

@script
    <script>
        window.addEventListener('cart-added', event => {
            setTimeout(() => {
                Livewire.emit('resetAddedToCart');
            }, 3000); // 3 seconds delay to reset button text
        });
    </script>
@endscript
