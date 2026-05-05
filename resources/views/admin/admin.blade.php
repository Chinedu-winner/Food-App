<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/heroicons@2.0.18/24/outline/index.js" type="module"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>@yield('page-title', 'Admin Dashboard') - FoodWin</title>
    <style>
        .sidebar-gradient { background: linear-gradient(135deg, #0f766e 0%, #059669 100%);}.main-bg {background: #f8fafc;}.card-shadow {box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);}
    </style>
</head>

<body class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <aside class="w-64 sidebar-gradient text-white flex flex-col shadow-xl">
        <div class="p-6 border-b border-white/20">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold">FoodWin Admin</h1>
                    <p class="text-sm text-white/70">Management Panel</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 mt-6 px-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-white/10 transition-all duration-200 group">
                        <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                        </svg>
                        Dashboard   
                    </a>
                </li>
            <li>
        <a href="{{ route('admin.management') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-white/10 transition-all duration-200 group">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
        </svg>
        Admin Management
    </a>
</li>

                <li class="relative group">
                    <span class="flex items-center px-4 py-3 rounded-lg hover:bg-white/10 transition-all duration-200 cursor-pointer group">
                        <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Orders
                        <svg class="w-4 h-4 ml-auto group-hover:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </span>
                    <ul class="hidden group-hover:block absolute left-full top-0 bg-white text-gray-800 w-56 shadow-2xl rounded-lg overflow-hidden border border-gray-200 z-50">
                        <li><a href="{{ route('orders.index') }}" class="block px-4 py-3 hover:bg-gray-50 transition">All Orders</a></li>
                        <li><a href="{{ route('admin.orders.track', 1) }}" class="block px-4 py-3 hover:bg-gray-50 transition">Track Order</a></li>
                    </ul>
                </li>

                <li class="relative group">
                    <span class="flex items-center px-4 py-3 rounded-lg hover:bg-white/10 transition-all duration-200 cursor-pointer group">
                        <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Food
                        <svg class="w-4 h-4 ml-auto group-hover:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </span>
                    <ul class="hidden group-hover:block absolute left-full top-0 bg-white text-gray-800 w-56 shadow-2xl rounded-lg overflow-hidden border border-gray-200 z-50">
                        <li><a href="{{ route('admin.foods.index') }}" class="block px-4 py-3 hover:bg-gray-50 transition">Food List</a></li>
                        <li><a href="{{ route('admin.foods.create') }}" class="block px-4 py-3 hover:bg-gray-50 transition">Add Food</a></li>
                    </ul>
                    
                </li>
                <li class="relative group">
                    <span class="flex items-center px-4 py-3 rounded-lg hover:bg-white/10 transition-all duration-200 cursor-pointer group">
                        <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        Categories
                        <svg class="w-4 h-4 ml-auto group-hover:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </span>
                    <ul class="hidden group-hover:block absolute left-full top-0 bg-white text-gray-800 w-56 shadow-2xl rounded-lg overflow-hidden border border-gray-200 z-50">
                        <li><a href="{{ route('admin.categories.index') }}" class="block px-4 py-3 hover:bg-gray-50 transition">Categories List</a></li>
                        <li><a href="{{ route('admin.categories.create') }}" class="block px-4 py-3 hover:bg-gray-50 transition">Add Category</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-white/10 transition-all duration-200 group">
                        <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        Users
                    </a>
                </li>
            </ul>
        </nav>

        <div class="p-4 border-t border-white/20">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center px-4 py-3 rounded-lg hover:bg-red-500/20 transition-all duration-200 text-red-300 group">
                <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Logout
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden main-bg">

<div x-data="{ open: false }" class="relative h-full flex flex-col">

<header class="bg-white px-6 py-4 flex justify-between items-center border-b">
    <h1 class="text-lg font-semibold text-gray-800">@yield('page-title')</h1>

    <button @click="open = true">
        <img 
        src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"  
        class="w-10 h-10 rounded-full border shadow-sm hover:scale-105 transition">
    </button>
</header>

<div x-show="open" x-transition.opacity class="fixed inset-0 bg-black/40 z-40" @click="open = false"></div>

<div x-show="open" x-transition:enter="transform transition ease-in-out duration-500" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-400" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="fixed top-0 right-0 h-full w-full sm:w-[380px]  bg-white shadow-2xl z-50 flex flex-col">

    <div class="bg-gray-100 px-6 py-5 border-b flex justify-between items-center">
        <h2 class="text-lg font-semibold">Google Account</h2>
        <button @click="open = false" class="text-gray-500 hover:text-gray-800 text-xl">✕</button>
    </div>

    <div class="flex flex-col items-center text-center px-6 py-8">
        <img src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name) }}" class="w-24 h-24 rounded-full shadow-md mb-4">

        <h3 class="text-lg font-semibold text-gray-900">{{ auth()->user()->name }}</h3>

        <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>

        <a href="{{ route('profile.edit') }}" class="mt-4 px-5 py-2 border rounded-full text-sm hover:bg-gray-100 transition"> Manage your account</a>
    </div>

    <div class="border-t"></div>

    <div class="flex-1 py-4">
        <a href="{{ route('profile.edit') }}"class="block px-8 py-3 text-gray-700 hover:bg-gray-100">Profile Settings</a>
        <a href="#"class="block px-8 py-3 text-gray-700 hover:bg-gray-100">Help</a>

    </div>
    <div class="border-t p-6">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg transition">Sign out</button>
        </form>
    </div>

</div> {{-- closes Gmail panel --}}

<section class="flex-1 p-6 overflow-y-auto">
    <div class="bg-white rounded-xl card-shadow p-6">
        @yield('content')
    </div>
</section>

</div> {{-- closes x-data div --}}
</main> {{-- only ONE closing main --}}

@stack('scripts')
</body>
</html>