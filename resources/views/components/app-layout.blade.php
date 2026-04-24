<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel App') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1DA1F2',
                    },
                },
            }
        }
    </script>
</head>
<body>

    <nav class="bg-green-900 text-slate-100 border-b-4 border-amber-400 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-16 flex items-center justify-between">
                <div class="flex items-center gap-6">
                    <a href="{{ route('dashboard') }}" class="text-xl font-extrabold tracking-wide text-amber-300">FoodWin</a>

                    <div class="hidden md:flex items-center gap-2">
                        <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-md text-sm font-semibold hover:bg-slate-800 transition-colors">Dashboard</a>
                        <a href="{{ route('settings.edit') }}" class="px-3 py-2 rounded-md text-sm font-semibold bg-slate-800 text-amber-300">Settings</a>
                        <a href="{{ route('profile.edit') }}" class="px-3 py-2 rounded-md text-sm font-semibold hover:bg-slate-800 transition-colors">Profile</a>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <span class="hidden sm:block text-sm text-slate-300">{{ Auth::user()->name ?? 'User' }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 rounded-md text-sm font-semibold bg-amber-500 text-slate-900 hover:bg-amber-400 transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        {{ $slot }}
    </main>

</body>
</html>