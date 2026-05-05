<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login - Food App</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-300 font-sans">
<div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">

<h2 class="text-2xl font-bold text-gray-800 text-center mb-2">Welcome to FoodWin.</h2>
    <p class="text-center text-gray-500 text-sm mb-6">Login Page.</p>
    
    @if($errors->any())
    <div class="text-red-600 text-sm mb-4 px-3 py-2 bg-red-100 rounded">
        {{ $errors->first() }}
    </div>
    @endif
    
    @if(session('error')) 
    <div class="text-red-600 text-sm mb-4 px-3 py-2 bg-red-100 rounded">
        {{ session('error') }}
    </div>
    @endif
    <form method="POST" action="{{ route('login.submit') }}" class="space-y-4">
    @csrf

    <div>
        <label class="block text-gray-700 text-sm mb-1">Email</label>
        <input name="email" type="email" placeholder="you@example.com" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:outline-none" value="{{ old('email') }}" required>
    </div>

    <div class="relative">
        <label class="block text-gray-700 text-sm mb-1">Password</label>
        <input id="password" name="password" type="password" placeholder="••••••••"
        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:outline-none" required>
    
        <button type="button" onclick="togglePassword()" class="absolute right-3 top-10 text-gray-500 hover:text-gray-700">👁</button>
    </div>

    <div class="flex justify-between items-center text-sm text-gray-600">
        <label class="flex items-center gap-2">
        <input type="checkbox" name="remember" class="h-4 w-4">Remember me</label>
        <a href="#" class="hover:text-teal-500">Forgot password?</a>
    </div> 
    <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-semibold py-3 rounded-lg transition"> Sign In </button>
    </form>

    <a href="{{ url('login/google') }}" class="flex items-center justify-center gap-3 border mt-3 border-gray-300 rounded-lg py-3 hover:bg-gray-50 transition">

        <img src="https://www.svgrepo.com/show/475656/google-color.svg" 
        alt="Google" class="w-5 h-5">
    
        <span class="text-gray-700 font-medium">Continue with Google</span>
    </a>
    
    <p class="mt-6 text-center text-gray-600 text-sm">Don't have an account?
        <a href="{{ route('register') }}" class="text-teal-500 hover:text-teal-600 font-medium">Register</a>
    </p>
</div>
</body>
</html>
<script>
document.addEventListener("DOMContentLoaded", function () {
    window.togglePassword = function () {
        const passwordInput = document.getElementById("password");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
});
</script>