@extends('admin.admin')
@section('page-title', 'All Users')
@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        
        <h2 class="text-2xl font-bold text-gray-700 mb-6">All Users</h2>
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs sticky top-0">
                        <tr>
                            <th class="py-4 px-6">ID</th>
                            <th class="py-4 px-6">Name</th>
                            <th class="py-4 px-6">Email</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                            <tr class="border-b hover:bg-gray-50 transition duration-200">
                                <td class="py-4 px-6 font-medium text-gray-900">{{ $user->id }}</td>
                                <td class="py-4 px-6">{{ $user->name }}</td>
                                <td class="py-4 px-6">{{ $user->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection