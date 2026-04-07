<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login - Food App</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-300 font-sans">

<div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Sign in to your account</h2>

    @if($errors->any())
    <div class="text-red-600 text-sm mb-4 px-3 py-2 bg-red-100 rounded">{{ $errors->first() }}</div>
    @endif

    @if(session('error')) 
    <div class="text-red-600 text-sm mb-4 px-3 py-2 bg-red-100 rounded">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}" class="space-y-4">
    @csrf
    <div>
        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
        <input id="email" name="email" placeholder="email@gmail" type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400"value="{{ old('email') }}" required autofocus>
    </div>

    <div style="position: relative;">
        <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
        <input id="password" name="password" placeholder="password" type="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400" required>
        <button type="button" onclick="togglePassword()" style="position: absolute; right: 10px; top: 38px;">👁</button>
    </div>


    <div class="flex justify-between items-center text-sm text-gray-600">
        <label class="flex items-center gap-2">
        <input type="checkbox" name="remember" class="h-4 w-4 rounded border-gray-300">Remember me
        </label>
        <a href="#" class="hover:text-teal-500">Forgot?</a>
    </div>

    <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-semibold py-3 rounded-lg transition-colors duration-200">Sign In</button>
    </form>

    <div class="mt-4 text-center">
    <a href="{{ url('login/google') }}" class="text-teal-500 hover:text-teal-600 font-medium inline-block">Sign in with Google </a>
    </div>
    
    <p class="mt-6 text-center text-gray-600 text-sm">Don't have an account? 
        <a href="{{ route('register') }}" class="text-teal-500 hover:text-teal-600 font-medium">Register</a>
    </p>

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