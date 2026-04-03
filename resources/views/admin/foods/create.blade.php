@extends('admin.admin')

@section('page-title')

@section('content')
<h1 class="text-2xl font-bold mb-4">Add New Food</h1>

<form action="{{ route('admin.food.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label class="block mb-2">Name</label>
    <input type="text" name="name" class="border p-2 w-full mb-4" required>

    <label class="block mb-2">Category</label>
   <select name="category_id" class="border p-2 w-full mb-4">
    <option value="1">Jollof Rice</option>
    <option value="2">Pounded Yam & Egusi Soup</option>
    <option value="3">Fried Rice</option>
    <option value="4">Moi Moi</option>
    <option value="5">Efo Riro</option>
    <option value="6">Suya</option>
    <option value="7">Amala & Ewedu</option>
    <option value="8">Yam Porridge</option>
    <option value="9">Pepper Soup</option>
    <option value="10">Akara</option>
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

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Food</button>
</form>
@endsection