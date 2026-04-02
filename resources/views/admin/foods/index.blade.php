@extends('admin.admin')

@section('page-title', 'Food List')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Food List</h1>
    <a href="{{ route('admin.food.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
        Add New Food
    </a>
</div>

<div class="mb-10">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
            <tr>
                <th class="px-6 py-4 border-b">ID</th>
                <th class="px-6 py-4 border-b">Name</th>
                <th class="px-6 py-4 border-b">Category</th>
                <th class="px-6 py-4 border-b">Price</th>
                <th class="px-6 py-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($foods as $food)
            <tr class="hover:bg-gray-50 transition border-b">
                <td class="px-6 py-4">{{ $food->id }}</td>
                <td class="px-6 py-4 font-semibold">{{ $food->name }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $food->category->name ?? 'N/A' }}</td>
                <td class="px-6 py-4 text-orange-600 font-bold">${{ number_format($food->price, 2) }}</td>
                <td class="display: inline-flex gap-5 text-sm">
                    <a href="{{ route('admin.food.edit', $food->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-200">Edit</a>
                    <form action="{{ route('admin.food.destroy', $food->id) }}" class="in-line" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<h2 class="text-xl font-bold mb-6 text-gray-800">Preview Layout (from Menu)</h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($foods as $food)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-full hover:shadow-md transition">
            <div class="h-40 bg-gray-200 relative">
                @if($food->image)
                    <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->name }}" class="h-full w-full object-cover">
                @endif
            </div>
            <div class="p-4 flex-grow">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-lg font-bold text-gray-900">{{ $food->name }}</h3>
                    <p class="font-black text-orange-600">${{ number_format($food->price, 2) }}</p>
                </div>
                <p class="text-gray-500 text-xs line-clamp-2">{{ $food->description }}</p>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-8">
    {{ $foods->links() }}
</div>
@endsection