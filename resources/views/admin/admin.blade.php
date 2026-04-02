<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin Dashboard - FoodWin</title>
</head>

<body class="flex h-screen bg-gray-100">
    <aside class="w-64 bg-gray-900 text-white flex flex-col shadow-lg">
        <div class="p-6 text-2xl font-extrabold border-b border-gray-700">FoodWin Admin</div>
        <nav class="flex-1 mt-4">
            <ul class="space-y-1">

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 hover:bg-gray-700 transition">Dashboard</a>
                </li>

                <li class="relative group">
                    <span class="block px-6 py-3 font-semibold cursor-pointer hover:bg-gray-700 transition">Orders</span>
                    <ul class="hidden group-hover:block absolute left-full top-0 bg-gray-800 w-56 shadow-xl rounded-md overflow-hidden">
                        <li><a href="{{ route('admin.orders') }}" class="block px-4 py-2 hover:bg-gray-700">All Orders</a></li>
                        <li><a href="{{ route('admin.orders.track', 1) }}" class="block px-4 py-2 hover:bg-gray-700">Order Track</a></li>
                        <li><a href="{{ route('admin.orders.show', 1) }}" class="block px-4 py-2 hover:bg-gray-700">Orders Show</a></li>

                        @if(isset($foods) && $foods->count())
                            <li class="border-t border-gray-600 my-1"></li>
                            @foreach($foods as $food)
                                <li>
                                    <a href="{{ route('admin.food.edit', $food->id) }}" class="block px-4 py-2 hover:bg-gray-700 text-sm">{{ $food->name }}</a>
                                </li>
                            @endforeach 
                        @endif
                    </ul>
                </li>

            <li class="relative group">
                <span class="block px-6 py-3 font-semibold cursor-pointer hover:bg-gray-700 transition">Food</span>
                <ul class="hidden group-hover:block absolute left-full top-0 bg-gray-800 w-56 shadow-xl rounded-md overflow-hidden">
                    <li><a href="{{ route('admin.food.index') }}" class="block px-4 py-2 hover:bg-gray-700">Food List</a></li>
                    <li><a href="{{ route('admin.food.create') }}" class="block px-4 py-2 hover:bg-gray-700">Add Food</a></li>
                    @if(isset($foods) && $foods->count())
                        <li class="border-t border-gray-600 my-1"></li>
                        @foreach($foods as $food)
                            <li>
                                <a href="{{ route('admin.food.edit', $food->id) }}" class="block px-4 py-2 hover:bg-gray-700 text-sm">{{ $food->name }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </li>

                <li class="relative group">
                    <span class="block px-6 py-3 font-semibold cursor-pointer hover:bg-gray-700 transition">Categories</span>
                    <ul class="hidden group-hover:block absolute left-full top-0 bg-gray-800 w-56 shadow-xl rounded-md overflow-hidden">
                        <li><a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 hover:bg-gray-700">Categories List</a></li>
                        <li><a href="{{ route('admin.categories.create') }}" class="block px-4 py-2 hover:bg-gray-700">Add Category</a></li>

                        @if(isset($categories) && $categories->count())
                            <li class="border-t border-gray-600 my-1"></li>
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="block px-4 py-2 hover:bg-gray-700">Edit {{ $category->name }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.users') }}" class="block px-6 py-3 hover:bg-gray-700 transition">Users</a>
                </li>

                <li class="mt-4 border-t border-gray-700 pt-2">
                    <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-6 py-3 hover:bg-red-600 transition text-red-300">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </li>

            </ul>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden">

        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">
                @yield('page-title')
            </h1>
        </header>

        <section class="flex-1 p-6 overflow-y-auto">
            <div class="bg-white rounded-xl shadow p-6">
                @yield('content')
            </div>
        </section>

    </main>

    @stack('scripts')
