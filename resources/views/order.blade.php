<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script src="https://cdn.tailwindcss.com"></script>
<title>Order Page</title>
</head>

<body class="bg-[#fdf6e3] text-gray-800 flex flex-col items-center p-6 lg:p-8 min-h-screen"> 
    <h1 class="text-3xl font-bold mb-6">Orders Page</h1>
    
    <form action="/order" method="POST" class="bg-white p-6 rounded-xl shadow-lg max-w-md w-full">
        @csrf        
        <div class="mb-4">
            <input type="text" name="name" placeholder="Your Name" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400" required>
        </div>
        
        <div class="mb-4">
            <input type="text" name="food_name" placeholder="Food Name" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400" required>
        </div>
        
        <div class="mb-4">
            <input type="number" name="quantity" placeholder="Quantity" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400" required>
        </div>
        
        <div class="mb-4">
            <input type="text" name="price" placeholder="Price" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400" required>
        </div>
        
        <button type="submit" class="w-full bg-yellow-400 text-gray-800 py-3 rounded-lg hover:bg-yellow-500 font-semibold transition-colors">Order Now</button>
        
    </form>

</body>
</html>