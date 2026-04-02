@extends('layout')

@section('page-title', 'Add Category')

@section('content')

<div class="max-w-2xl mx-auto mt-10 p-8 rounded-xl shadow-md bg-[#fdf6e3] p-6">

    <h1 class="text-2xl font-bold mb-6 text-gray-800">Add Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-gray-700 mb-1">Name</label>
            <input type="text" name="name" class="w-full border px-4 py-2 rounded-lg">
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Slug</label>
            <input type="text" name="slug" class="w-full border px-4 py-2 rounded-lg">
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Description</label>
            <textarea name="description" class="w-full border px-4 py-2 rounded-lg"></textarea>
        </div>

        <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Add Category</button>
    </form>

</div>
@endsection