@extends('admin.admin')

@section('page-title', 'Food List')

@section('content')
<style>
    :root {
        --bistro-bg: #f8f1e9;
        --bistro-dark: #2d1e12;
        --bistro-title: #6b3e26;
        --bistro-subtitle: #8b5a2b;
        --bistro-heading: #8b4513;
        --bistro-border: #d4a373;
        --bistro-price: #b22222;
        --bistro-star: #ffa41c;
    }
</style>

<div class="flex justify-between items-center mb-6">in
    <h1 class="text-3xl font-bold" style="color: var(--bistro-title);">Food List</h1>
    <a href="{{ route('admin.food.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium">+ Add New Food</a>
</div>

<div class="mb-12" style="background-color: rgb(233,226,207)" class="rounded-lg shadow">
    <table class="w-full text-left border-collapse">
        <thead style="background-color: var(--bistro-bg);">
            <tr>
                <th class="px-6 py-4 border-b font-semibold" style="color: var(--bistro-heading);">ID</th>
                <th class="px-6 py-4 border-b font-semibold" style="color: var(--bistro-heading);">Name</th>
                <th class="px-6 py-4 border-b font-semibold" style="color: var(--bistro-heading);">Category</th>
                <th class="px-6 py-4 border-b font-semibold" style="color: var(--bistro-heading);">Price</th>
                <th class="px-6 py-4 border-b font-semibold" style="color: var(--bistro-heading);">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($foods as $food)
            <tr class="hover:bg-gray-50 transition border-b">
                <td class="px-6 py-4">{{ $food->id }}</td>
                <td class="px-6 py-4 font-semibold">{{ $food->name }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $food->category->name ?? 'N/A' }}</td>
                <td class="px-6 py-4 font-bold" style="color: var(--bistro-price);">${{ number_format($food->price, 2) }}</td>
                <td class="px-6 py-4 text-sm flex gap-2">
                    <a href="{{ route('admin.food.edit', $food->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Edit</a>
                    <form action="{{ route('admin.food.destroy', $food->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mb-8">
    <h2 class="text-3xl md:text-4xl font-semibold mb-8 pb-4 border-b-4 inline-block" style="color: var(--bistro-heading); border-color: var(--bistro-border);"> Food Menu Preview</h2>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
    @forelse($foods as $food)
        <div style="background-color: rgb(233,226,207)" class="rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
            <div class="h-56 md:h-64 bg-gray-300 relative overflow-hidden">
                @if($food->image)
                    <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-gray-400 to-gray-500 flex items-center justify-center">
                        <span class="text-white text-lg font-semibold">No Image</span>
                    </div>
                @endif
            </div>
            
            <div class="p-6">
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">{{ $food->name }}</h3>
                <p class="text-gray-600 mb-6 min-h-[3rem] text-sm leading-relaxed">{{ $food->description ?? 'No description available' }}</p>
                
                <div class="flex items-center justify-between">
                    <span class="text-2xl font-bold" style="color: var(--bistro-price);">${{ number_format($food->price, 2) }}</span>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.food.edit', $food->id) }}" class="px-3 py-2 bg-blue-500 text-white text-sm rounded-lg hover:bg-blue-600 transition-colors">Edit</a>
                        <form action="{{ route('admin.food.destroy', $food->id) }}" method="POST" onsubmit="return confirm('Delete this food?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition-colors">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12">
            <p class="text-gray-500 text-lg mb-4">No foods found. Let's add some!</p>
            <a href="{{ route('admin.food.create') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Add First Food</a>
        </div>
    @endforelse
</div>

@if($foods->hasPages())
    <div class="mt-8">
        {{ $foods->links() }}
    </div>
@endif

@endsection