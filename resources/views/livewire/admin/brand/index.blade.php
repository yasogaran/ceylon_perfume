<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Brands</h2>
        <a href="{{ route('admin.brands.create') }}" class="bg-blue-600 text-black px-4 py-2 rounded">Add brand</a>
    </div>

    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3">#</th>
                <th class="p-3">Title</th>
                <th class="p-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($brands as $brand)
                <tr class="border-b">
                    <td class="p-3">{{ $brand->id }}</td>
                    <td class="p-3">{{ $brand->title }}</td>
                    <td class="p-3 text-right space-x-2">
                        <a href="{{ route('admin.brands.edit', $brand->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <button wire:click="delete({{ $brand->id }})" class="text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="p-3 text-center">No categories found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $brands->links() }}
    </div>
</div>
