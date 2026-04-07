<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<title>Food App Dashboard</title>
</head>
<body class="flex bg-gradient-to-br from-orange-100 via-red-50 to-yellow-100 font-sans min-h-screen" style="background-image: linear-gradient(135deg, #fef3c7 0%, #fed7aa 25%, #fecaca 50%, #fef3c7 75%, #fed7aa 100%), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1920&h=1080&fit=crop&auto=format'); background-size: cover, cover; background-blend-mode: overlay;">
<div class="w-60 h-screen bg-gradient-to-b from-purple-800 via-blue-900 to-indigo-900 p-6 shadow-xl flex flex-col">
  <div class="bg-gray-50 bg-opacity-20 backdrop-blur-sm rounded-lg p-4 mb-8">
    <h2 class="text-2xl font-bold text-white text-center">🍽️ FoodWin</h2>
  </div><ul class="space-y-3 flex-1">
    <li class="px-4 py-2 rounded-lg text-white hover:bg-gray-50 hover:bg-opacity-20 hover:text-white flex items-center gap-2 cursor-pointer transition-all duration-200">
        <a href="{{route('admin.login')}}" class="flex items-center gap-2 text-white hover:text-white">
            <span>👥</span> Admin page
        </a>
    </li>

    <li class="px-4 py-2 rounded-lg text-white hover:bg-gray-50 hover:bg-opacity-20 hover:text-white flex items-center gap-2 cursor-pointer transition-all duration-200"><a href="{{ route('order') }}" class="flex items-center gap-2 text-white hover:text-white"><span>🛒</span> Orders</a></li>
      <li class="px-4 py-2 rounded-lg text-white hover:bg-gray-50 hover:bg-opacity-20 hover:text-white flex items-center gap-2 cursor-pointer transition-all duration-200">
        <a href="{{ route('track') }}" class="flex items-center gap-2 text-white hover:text-white">
            <span>✉️</span> Track
        </a>
    </li>

    <li class="px-4 py-2 rounded-lg text-white hover:bg-gray-50 hover:bg-opacity-20 hover:text-white flex items-center gap-2 cursor-pointer transition-all duration-200">
        <a href="{{route('analytics')}}" class="flex items-center gap-2 text-white hover:text-white">
            <span>📊</span> Analytics
        </a>
    </li>
  
  <ul class="space-y-3 flex-1">

    <!-- Other menu items -->
    <li class="px-4 py-2 rounded-lg text-white hover:bg-gray-50 hover:bg-opacity-20 flex items-center gap-2 cursor-pointer transition-all duration-200">
        <a href="{{ route('admin.login') }}" class="flex items-center gap-2 text-white hover:text-white">👥 Admin page</a>
    </li>
    <li class="px-4 py-2 rounded-lg text-white hover:bg-gray-50 hover:bg-opacity-20 flex items-center gap-2 cursor-pointer transition-all duration-200">
        <a href="{{ route('order') }}" class="flex items-center gap-2 text-white hover:text-white">🛒 Orders</a>
    </li>
    <li class="px-4 py-2 rounded-lg text-white hover:bg-gray-50 hover:bg-opacity-20 flex items-center gap-2 cursor-pointer transition-all duration-200">
      <a href="{{ route('settings.index') }}" class="flex items-center gap-2 text-white hover:text-white">🔒 Settings</a>
    </li>

</ul>
<div class="text-sm text-white text-opacity-70 mt-auto">© FoodWin 2026</div>
</div>
<div class="flex-1 p-6">

  <div class="bg-cover bg-center rounded-xl p-8 mb-8 text-white" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200&h=400&fit=crop&auto=format')">
    <h1 class="text-4xl font-bold mb-4">Welcome to FoodWin Dashboard</h1>
    <p class="text-xl opacity-90">Manage your orders, track deliveries, and enjoy delicious food!</p>
  </div>

  <div class="flex justify-between items-center mb-6 gap-4 flex-wrap">
    <a href="{{ route('order') }}" class="px-5 py-2 rounded-full bg-teal-600 text-white hover:bg-teal-700 shadow-md">
      Open Orders Filters
    </a>
    <div class="flex items-center gap-4">
      <button class="relative bg-gray-50 p-2 rounded-full shadow-md hover:shadow-lg transition-shadow">
        🔔
        <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
      </button>
      <div class="flex items-center gap-2 bg-gray-50 p-2 rounded-full shadow-md">
        <img src="{{ Auth::check() && Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::check() ? Auth::user()->name : 'Guest') }}" alt="avatar" class="w-8 h-8 rounded-full border-2 border-teal-400 object-cover"/>
        <span class="text-gray-700 font-medium">Hello, {{ Auth::check() ? Auth::user()->name : 'Guest' }}</span>
      </div>
    </div>
  </div>


  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-gray-50 p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-white bg-cover bg-center" style="background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url('https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=300&h=200&fit=crop&auto=format')">
      <div class="bg-black bg-opacity-50 rounded-lg p-4">
        <h3 class="text-3xl font-bold mb-2">75</h3>
        <span class="text-lg opacity-90">📦 Total Orders</span>
      </div>
    </div>
    <div class="bg-red-400 p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-green-200 bg-cover bg-center" style="background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=300&h=200&fit=crop&auto=format')">
      <div class="bg-black bg-opacity-50 rounded-lg p-4">
        <h3 class="text-3xl font-bold mb-2">$357</h3>
        <span class="text-lg opacity-90">💰 Total Revenue</span>
    </div>
    </div>
    <div class="bg-gray-50 p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-white bg-cover bg-center" style="background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url('https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=300&h=200&fit=crop&auto=format')">
    <div class="bg-black bg-opacity-50 rounded-lg p-4">
        <h3 class="text-3xl font-bold mb-2">65</h3>
        <span class="text-lg opacity-90">✅ Delivered</span>
    </div>
    </div>
    <div class="bg-gray-50 p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-white bg-cover bg-center" style="background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url('https://images.unsplash.com/photo-1556909114-4c36e03d6b3e?w=300&h=200&fit=crop&auto=format')">
    <div class="bg-black bg-opacity-50 rounded-lg p-4">
        <h3 class="text-3xl font-bold mb-2">12</h3>
        <span class="text-lg opacity-90">⏳ Pending</span>
    </div>
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-gray-50 p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-center mb-4">
        <div class="bg-gradient-to-r from-teal-400 to-teal-600 p-3 rounded-full mr-3">📊
        </div>
        <h4 class="font-semibold text-gray-700 text-lg">Orders Distribution</h4>
    </div>
    <canvas id="chartupdate" class="w-full h-48"></canvas>
    </div>
    <div class="bg-gray-50 p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
    <div class="flex items-center justify-center mb-4">
        <div class="bg-gradient-to-r from-orange-400 to-orange-600 p-3 rounded-full mr-3">💰</div>
        <h4 class="font-semibold text-gray-700 text-lg">Revenue Distribution</h4>
    </div>
    <canvas id="updatepie" class="w-full h-48"></canvas>
    </div>
</div>

<div class="bg-gray-50 p-6 rounded-xl shadow-md mb-8">
    <div class="flex items-center justify-center mb-6">
        <div class="bg-gradient-to-r from-green-400 to-green-600 p-3 rounded-full mr-3">📈</div>
        <h4 class="font-semibold text-gray-700 text-xl">Weekly Orders Trend</h4>
    </div>
    <canvas id="chartlink" class="w-full h-64"></canvas>
    </div>
    <div class="bg-gradient-to-r from-red-400 to-red-600 rounded-xl p-8 text-white text-center shadow-lg hover:shadow-xl transition-shadow bg-cover bg-center" style="background-image: linear-gradient(rgba(239, 68, 68, 0.9), rgba(220, 38, 38, 0.9)), url('https://images.unsplash.com/photo-1565299507177-b0ac66763828?w=800&h=200&fit=crop&auto=format')">
    <h3 class="text-2xl font-bold mb-4">Hungry? Order Now!</h3>
    <p class="text-lg mb-6 opacity-90">Get delicious food delivered to your doorstep</p>
    <button class="bg-gray-50 text-red-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-all shadow-md hover:shadow-lg transform hover:scale-105">
    <a href="{{ route('meal.index') }}" class="block">🍕 Order Now</a>
    </button>
</div>

</div> 

<script>
const chart1 = document.getElementById('chartupdate');
const chart2 = document.getElementById('updatepie');
const chart3 = document.getElementById('chartlink');

const pieData = {
  labels: ['Produce', 'Order', 'Delivered'],
  datasets: [{
    data: [57, 20, 23],
    backgroundColor: ['#14b8a6', '#facc64', '#ef4444']
}]
};

const barData = {
  labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
  datasets: [{
    label: 'Orders',
    data: [12, 19, 14, 18, 22, 16, 20],
    backgroundColor: '#14b8a6'
  }]
};

new Chart(chart1, { type: 'pie', data: pieData, options: { responsive: true, plugins: { legend: { position: 'bottom' } } }});
new Chart(chart2, { type: 'pie', data: pieData, options: { responsive: true, plugins: { legend: { position: 'bottom' } } }});
new Chart(chart3, { type: 'bar', data: barData, options: { responsive: true, plugins: { legend: { display: false } } }});
</script>
