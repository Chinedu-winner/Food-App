@extends('admin.layouts.app')

@section('content')
<h1>Edit Category</h1>
<form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-5">
    @csrf
    <div>
        <label>Name</label>
        <input type="text" name="name">
    </div>
    <div>
        <label>Slug</label>
        <input type="text" name="slug">
    </div>
    <div>
        <label>Description</label>
        <textarea name="description"></textarea>
    </div>
    <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Add Category</button>
</form> 
@endsection