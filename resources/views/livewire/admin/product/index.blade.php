<div class="p-4">
    <h1 class="text-2xl font-semibold mb-4">Products</h1>

    @if (session()->has('message'))
        <div class="mb-4 text-green-600 font-medium">{{ session('message') }}</div>
    @endif

    <div class="mb-4 flex justify-between items-center">
        <input type="text" wire:model.debounce.500ms="search" placeholder="Search products..."
            class="border px-3 py-2 rounded w-1/3">

        <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Add Product
        </a>
    </div>

    <table class="w-full table-auto border">
        <thead class="bg-gray-100">
            <tr class="text-left">
                <th class="p-2 border">Image</th>
                <th class="p-2 border">Title</th>
                <th class="p-2 border">Category</th>
                <th class="p-2 border">Brand</th>
                <th class="p-2 border">Price</th>
                <th class="p-2 border">Qty</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-2 border">
                        @if ($product->images && $product->images->first())
                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                alt="{{ $product->title }}" class="h-12 w-12 object-cover rounded">
                        @else
                            <span class="text-gray-400">No Image</span>
                        @endif
                    </td>
                    <td class="p-2 border">{{ $product->title }}</td>
                    <td class="p-2 border">{{ $product->category->title ?? '-' }}</td>
                    <td class="p-2 border">{{ $product->brand->title ?? '-' }}</td>
                    <td class="p-2 border">Rs. {{ number_format($product->price, 2) }}</td>
                    <td class="p-2 border">{{ $product->quantity }}</td>
                    <td class="p-2 border">
                        <a href="{{ route('admin.products.edit', $product->id) }}"
                            class="text-blue-600 hover:underline mr-2">Edit</a>

                        <button wire:click="delete({{ $product->id }})" class="text-red-600 hover:underline"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-4 text-center text-gray-500">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
