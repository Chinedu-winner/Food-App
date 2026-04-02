<!DOCTYPE html>
<html>
<head>
    <title>@yield('page-title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-70 min-h-screen p-6">
    @yield('content')
    @yield('scripts')
</body>
</html>