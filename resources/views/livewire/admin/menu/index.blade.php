<div class="p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Menus</h1>
        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">Add Menu</a>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('message') }}</div>
    @endif

    <table class="table-auto w-full border">
        <thead>
            <tr>
                <th class="border px-4 py-2">Order</th>
                <th class="border px-4 py-2">Title</th>
                <th class="border px-4 py-2">URL</th>
                <th class="border px-4 py-2">Category</th>
                <th class="border px-4 py-2">Brand</th>
                <th class="border px-4 py-2">Enabled</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
                <tr>
                    <td class="border px-4 py-2">{{ $menu->order }}</td>
                    <td class="border px-4 py-2">{{ $menu->title }}</td>
                    <td class="border px-4 py-2">{{ $menu->url }}</td>
                    <td class="border px-4 py-2">{{ $menu->category->title ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $menu->brand->title ?? '-' }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="toggleEnabled({{ $menu->id }})" class="text-blue-600">
                            {{ $menu->enabled ? 'Yes' : 'No' }}
                        </button>
                    </td>
                    <td class="border px-4 py-2 whitespace-nowrap">
                        <a href="{{ route('admin.menus.edit', $menu->id) }}" class="text-green-600 mr-2">Edit</a>
                        <button wire:click="deleteMenu({{ $menu->id }})" class="text-red-600" onclick="confirm('Delete this menu?') || event.stopImmediatePropagation()">Delete</button>
                        <button wire:click="moveUp({{ $menu->id }})" class="ml-2 text-gray-600">⬆️</button>
                        <button wire:click="moveDown({{ $menu->id }})" class="ml-1 text-gray-600">⬇️</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
