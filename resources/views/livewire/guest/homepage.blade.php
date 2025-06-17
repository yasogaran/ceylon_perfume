<div class="space-y-10">

    @foreach ($sections as $section)
    
        <section>
            <h2 class="text-2xl font-semibold mb-4">
                {{ $section->title ?? ($section->category->title ?? 'Featured') }}
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                @foreach ($section->products as $product)
                    <div class="bg-blue-400 rounded shadow p-4 flex flex-col">
                        @if ($product->images->first())
                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                alt="{{ $product->title }}" class="h-40 w-full object-cover rounded mb-3">
                        @else
                            <div class="h-40 w-full bg-gray-200 rounded mb-3"></div>
                        @endif

                        <h3 class="font-semibold text-lg text-blue-800">{{ $product->title }}</h3>
                        <p class="text-gray-600 text-sm line-clamp-2">{{ strip_tags($product->about) }}</p>

                        <div class="mt-auto pt-3">
                            <div class="text-indigo-600 font-bold text-lg">
                                @if ($product->offer_price)
                                    <span
                                        class="line-through text-gray-400 mr-2">${{ number_format($product->price, 2) }}</span>
                                    <span>${{ number_format($product->offer_price, 2) }}</span>
                                @else
                                    ${{ number_format($product->price, 2) }}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach

</div>
