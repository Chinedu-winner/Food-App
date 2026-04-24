<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Food App')</title>
    @if (file_exists(public_path('css/app.css')))
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="bg-slate-50">
    <nav class="bg-teal-900 text-white border-b-4 border-amber-400 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-16 flex items-center justify-between">
                <div class="flex items-center gap-6">
                    <a href="{{ route('dashboard') }}" class="text-xl font-extrabold tracking-wide text-amber-300">FoodWin</a>

                    <div class="hidden md:flex items-center gap-2">
                        <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-md text-sm font-semibold hover:bg-teal-800 transition-colors {{ request()->routeIs('dashboard') ? 'bg-teal-800 text-amber-300' : '' }}">Dashboard</a>
                        <a href="{{ route('analytics') }}" class="px-3 py-2 rounded-md text-sm font-semibold hover:bg-teal-800 transition-colors {{ request()->routeIs('analytics') ? 'bg-teal-800 text-amber-300' : '' }}">Analytics</a>
                        <a href="{{ route('track') }}" class="px-3 py-2 rounded-md text-sm font-semibold hover:bg-teal-800 transition-colors {{ request()->routeIs('track') ? 'bg-teal-800 text-amber-300' : '' }}">Track Order</a>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-md text-sm font-semibold hover:bg-teal-800 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-teal-800 text-amber-300' : '' }}">Admin</a>
                            @endif
                        @endauth
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    @auth
                        <span class="hidden sm:block text-sm text-teal-100">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-3 py-1.5 rounded-md text-sm font-semibold bg-amber-500 text-slate-900 hover:bg-amber-400 transition-colors">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-3 py-1.5 rounded-md text-sm font-semibold bg-amber-500 text-slate-900 hover:bg-amber-400 transition-colors">Login</a>
                    @endauth
                </div>
            </div>

            <div class="md:hidden pb-3 flex flex-wrap gap-2">
                <a href="{{ route('dashboard') }}" class="px-3 py-1 rounded-md text-xs font-semibold bg-teal-800/70">Dashboard</a>
                <a href="{{ route('analytics') }}" class="px-3 py-1 rounded-md text-xs font-semibold bg-teal-800/70">Analytics</a>
                <a href="{{ route('track') }}" class="px-3 py-1 rounded-md text-xs font-semibold bg-teal-800/70">Track</a>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @yield('content')
        @yield('scripts')
    </div>
</body>
</html>
