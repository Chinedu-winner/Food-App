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

    <nav style="padding:10px; background:#eee;">
        <a href="/dashboard">Dashboard</a> |
        <a href="/settings/profile">Profile</a>
    </nav>

    <main style="padding:20px;">
        {{ $slot }}
    </main>

</body>
</html>