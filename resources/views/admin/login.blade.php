<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1600891964599-f61ba0e24092?auto=format&fit=crop&w=1470&q=80');">

    <div class="bg-white/90 p-8 rounded-2xl shadow-lg max-w-md w-full">
        <h2 class="text-3xl font-bold text-orange-600 mb-6 text-center">Admin Login</h2>
        <span class="text-gray-700 font-medium">Hello, {{ Auth::check() ? Auth::user()->name : 'Guest' }}, Welcome to FoodWin, where your request is our maximum satisfaction. </span>
        @if(session('error'))
            <p class="text-blue-900 text-center mb-4">{{ session('error') }}</p>
        @endif 
        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
        </div>

        <div>
                <label class="block text-gray-700 font-semibold mb-1">Admin ID</label>
                <input type="number" name="admin_id" value="{{ old('admin_id') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

        <div>
                <label class="block text-gray-700 font-semibold mb-1">Password</label>

    <div class="relative">
        <input type="password" id="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
        <button type="button" onclick="togglePassword()" class="absolute right-3 top-2 text-gray-600" id="toggleBtn">👁</button>
    </div>
    </div>
        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 rounded-lg transition duration-300">Login</button>
        </form>
    </div>

</body>
</html>
<script>
function togglePassword() {
    const passwordInput = document.getElementById("password");

    if (passwordInput.type === "password") {
    passwordInput.type = "text";
    } else {
    passwordInput.type = "password";
    }
}
</script>