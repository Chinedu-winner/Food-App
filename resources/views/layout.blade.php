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
<body class="bg-gray-50">
    <nav class="bg-gray-800 p-4 text-white flex justify-between">
        <div class="space-x-4">
            <a href="{{ route('dashboard') }}">Home</a>
            <a href="{{ route('analytics') }}">Menu</a>

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                @endif
            @endauth
        </div>

        <div>
            @auth
                <span>{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>      
                @else
                <a href="{{ route('login') }}">Login</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                <a href="{{ route('login') }}">Login</a>
                </form>          
        @endauth
        </div>
    </nav>

    <div class="p-6">
        @yield('content')
    @yield('scripts')
    </div>
</body>
</html>
