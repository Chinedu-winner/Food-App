@extends('admin.admin') {{-- ⚠️ Change 'layouts.admin' to match your actual layout filename --}}

@section('page-title', 'Admin Management')

@section('content')

{{-- Success / Error Messages --}}
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-sm">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-sm">
        {{ session('error') }}
    </div>
@endif
@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-sm">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

{{-- Create New Admin Form --}}
<div class="mb-8">
    <h3 class="text-lg font-bold text-teal-700 mb-4">Create New Admin</h3>
    <form method="POST" action="{{ route('admin.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf
        <div>
            <label class="block text-gray-700 font-semibold mb-1 text-sm">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Tayo Chibundo"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:rin g-2 focus:ring-teal-400 text-sm">
        </div>
        <div>
            <label class="block text-gray-700 font-semibold mb-1 text-sm">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="e.g. admin@foodwin.com"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm">
        </div>
   <div class="relative">
    <label class="block text-gray-700 font-semibold mb-1 text-sm">Password</label>
    
    <input type="password" id="password" name="password" requiredplaceholder="Min 6 characters"class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm">

    <span onclick="togglePassword('password', this)"class="absolute right-3 top-9 cursor-pointer text-gray-500">👁️</span>
</div>

<div class="relative">
    <label class="block text-gray-700 font-semibold mb-1 text-sm">Confirm Password</label>  
    <input type="password" id="confirm_password" name="password_confirmation" required placeholder="Repeat password" class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm">

    <span onclick="togglePassword('confirm_password', this)" class="absolute right-3 top-9 cursor-pointer text-gray-500">👁️</span>
</div>
        <div class="md:col-span-2">
            <button type="submit"class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-6 py-2 rounded-lg transition duration-300 text-sm">+ Create Admin</button>
            <p class="text-gray-400 text-xs mt-2">An Admin ID will be automatically generated.</p>
        </div>
    </form>
</div>

<hr class="mb-8 border-gray-200">

{{-- Admin List Table --}}
<div>
    <h3 class="text-lg font-bold text-teal-700 mb-4">All Admins</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-teal-50 text-teal-700 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3 rounded-tl-lg">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Admin ID</th>
                    <th class="px-4 py-3 rounded-tr-lg text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($admins as $admin)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 font-semibold text-gray-800">{{ $admin->name }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $admin->email }}</td>
                    <td class="px-4 py-3">
                        @if($admin->admin_id)
                            <span class="bg-teal-100 text-teal-700 px-2 py-1 rounded font-mono text-xs">{{ $admin->admin_id }}</span>
                        @else
                            <span class="bg-gray-100 text-gray-400 px-2 py-1 rounded text-xs">Not Assigned</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex gap-2 justify-center">
                            {{-- Generate ID Button --}}
                            @if(!$admin->admin_id)
                            <form method="POST" action="{{ route('admin.generate.id', $admin->id) }}">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs font-semibold transition">Generate ID</button>
                            </form>
                            @endif
                            {{--Edit ID link --}}
                                <a href="{{ route('admin.edit.id', $admin->id) }}"class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">Edit ID</a>
                            <a href="{{ route('admin.edit.id', $admin->id) }}"class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs font-semibold transition">Edit ID</a>
                            @if($admin->id !== 1)
                            <form method="POST" action="{{ route('admin.destroy', $admin->id) }}"
                                onsubmit="return confirm('Are you sure you want to delete {{ $admin->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs font-semibold transition">Delete</button>
                            </form>
                            @else
                            <span class="bg-gray-100 text-gray-400 px-3 py-1 rounded text-xs">Super Admin</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-gray-400">No admins found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
<script>
function togglePassword(fieldId, el) {
    const input = document.getElementById(fieldId);

    if (input.type === "password") {
        input.type = "text";
        el.innerText = "🙈"; // change icon
    } else {
        input.type = "password";
        el.innerText = "👁️";
    }
}
</script>