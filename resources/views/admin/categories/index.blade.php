<a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Category</a>

@if(session('success'))
    <div class="bg-green-200 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

<table class="w-full table-auto border border-gray-300 rounded-md">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2 border">ID</th>
            <th class="px-4 py-2 border">Name</th>
            <th class="px-4 py-2 border">Slug</th>
            <th class="px-4 py-2 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr class="hover:bg-gray-100">
            <td class="px-4 py-2 border">{{ $category->id }}</td>
            <td class="px-4 py-2 border">{{ $category->name }}</td>
            <td class="px-4 py-2 border">{{ $category->slug }}</td>
            <td class="px-4 py-2 border space-x-2">
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>