<div class="p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Homepage Sections</h1>
        <a href="{{ route('admin.homepage.sections.create') }}" class="btn btn-primary">Add Section</a>
    </div>

    <table class="table-auto w-full border">
        <thead>
            <tr>
                <th class="px-4 py-2">Order</th>
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Category</th>
                <th class="px-4 py-2">Limit</th>
                <th class="px-4 py-2">Enabled</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sections as $section)
                <tr>
                    <td class="border px-4 py-2">{{ $section->order }}</td>
                    <td class="border px-4 py-2">{{ $section->title ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $section->category->title ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $section->product_limit }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="toggleVisibility({{ $section->id }})" class="text-sm text-blue-600">
                            {{ $section->enabled ? 'Yes' : 'No' }}
                        </button>
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.homepage.sections.edit', $section->id) }}" class="text-sm text-green-600 mr-2">Edit</a>
                        <button wire:click="moveUp({{ $section->id }})" class="text-sm text-gray-500 mr-1">⬆️</button>
                        <button wire:click="moveDown({{ $section->id }})" class="text-sm text-gray-500">⬇️</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
