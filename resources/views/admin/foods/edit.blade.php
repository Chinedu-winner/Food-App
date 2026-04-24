@extends('admin.admin')  <!-- Extends your main admin layout -->

@section('page-title', 'Edit Food')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Food</h1>

<form action="{{ route('admin.foods.update', $food->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label class="block mb-2">Name</label>
    <input type="text" name="name" value="{{ old('name', $food->name) }}" class="border p-2 w-full mb-4" required>
    
    <label class="block mb-2">Category</label>
    <select name="category_id" class="border p-2 w-full mb-4" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $food->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <label class="block mb-2">Price</label>
    <input type="number" name="price" value="{{ old('price', $food->price) }}" class="border p-2 w-full mb-4" step="0.01" required>

    <label class="block mb-2">Description</label>
    <textarea name="description" class="border p-2 w-full mb-4">{{ old('description', $food->description) }}</textarea>

    <label class="block mb-2">Image</label>
    @if($food->image)
        <div class="mb-2">
            <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->name }}" class="w-32 h-32 object-cover rounded">
        </div>
    @endif
    <input type="file" name="image" class="mb-4">

    <label class="block mb-2">Status</label>
    <select name="status" class="border p-2 w-full mb-4" required>
        <option value="active" {{ $food->status == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ $food->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Food</button>
</form>
@endsection