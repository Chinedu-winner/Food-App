@extends('admin.admin')

@section('page-title', 'Edit Admin ID')

@section('content')

<div class="max-w-md">
    <h3 class="text-lg font-bold text-teal-700 mb-1">Edit Admin ID</h3>
    <p class="text-gray-500 text-sm mb-6">Updating ID for <span class="font-semibold text-gray-700">{{ $admin->name }}</span></p>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.update.id', $admin->id) }}">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1 text-sm">Current Admin ID</label>
            <input type="text" value="{{ $admin->admin_id ?? 'Not Assigned' }}" disabled
                class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-400 text-sm">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-1 text-sm">New Admin ID</label>
            <input type="text" name="admin_id" value="{{ old('admin_id') }}" required
                placeholder="Enter new Admin ID"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm">
        </div>

        <div class="flex gap-3">
            <button type="submit"
                class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-6 py-2 rounded-lg transition text-sm">
                Update ID
            </button>
            <a href="{{ route('admin.management') }}"
                class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-2 rounded-lg transition text-sm">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection