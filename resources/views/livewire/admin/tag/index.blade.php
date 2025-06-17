<div class="p-4 space-y-4">
    <a href="{{ route('admin.tags.create') }}" class="bg-green-600 text-white px-3 py-1 rounded">+ Add Tag</a>

    <table class="table-auto w-full mt-4">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="px-2 py-1">Title</th>
                <th class="px-2 py-1">Type</th>
                <th class="px-2 py-1">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr class="border-t">
                    <td class="px-2 py-1">{{ $tag->title }}</td>
                    <td class="px-2 py-1">{{ $tag->type }}</td>
                    <td class="px-2 py-1">
                        <a href="{{ route('admin.tags.edit', $tag) }}" class="text-blue-600">Edit</a>
                        <button wire:click="delete({{ $tag->id }})" class="text-red-600 ml-2">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
