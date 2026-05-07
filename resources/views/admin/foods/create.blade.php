@extends('admin.admin')

@section('page-title', 'Add New Food')

@section('content')
<h1 class="text-2xl font-bold mb-4">Add New Food</h1>

<form action="{{ route('admin.foods.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label class="block mb-2">Name</label>
    <input type="text" name="name" class="border p-2 w-full mb-4" required>

    <label class="block mb-2">Category</label>
    <select name="category_id" class="border p-2 w-full mb-4" required>
        <option value="">-- Select a Category --</option>
        @forelse($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @empty
            <option disabled>No categories available</option>
        @endforelse
    </select>

    <label class="block mb-2">Price</label>
    <input type="number" name="price" class="border p-2 w-full mb-4" step="0.01" required>

    <label class="block mb-2">Description</label>
    <textarea name="description" class="border p-2 w-full mb-4"></textarea>

    <label class="block mb-2">Image</label>
    <input type="file" name="image" class="mb-4">

    <label class="block mb-2">Status</label>
    <select name="status" class="border p-2 w-full mb-4">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>

    <div class="flex gap-3">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Food</button>
        <a href="{{ route('meal.index') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 inline-flex items-center">View on Meal Page</a>
    </div>
</form>
@endsection