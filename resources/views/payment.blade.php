<!DOCTYPE html>
<html>
<head>
<title>Order Confirmation</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="bg-white shadow-hxl rounded-xl p-8 w-[400px]">
    <h2 class="text-2xl font-bold text-green-600 mb-4">Payment Successful</h2>

<p class="mb-2">
<strong>Name:</strong> {{ $user->name }}
</p>

<p class="mb-2">
<strong>Food Ordered:</strong> {{ $meal->name }}
</p>

<p class="mb-2">
<strong>Price:</strong> ${{ $meal->price }}
</p>

<p class="mb-4 text-gray-600">
Your order will be delivered within **30 minutes**.
</p>

<a href="/meal" class="bg-green-500 text-white px-4 py-2 rounded-lg">
Order Again
</a>

</div>

</body>
</html>