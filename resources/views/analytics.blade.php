@extends('layout')

@section('content')
<form method="GET" action="{{ route('analytics') }}" class="mb-6 flex gap-4">
    <select name="range" onchange="this.form.submit()" class="p-2 border rounded">
        <option value="7" {{ request('range') == 7 ? 'selected' : '' }}>Last 7 Days</option>
        <option value="30" {{ request('range') == 30 ? 'selected' : '' }}>Last 30 Days</option>
        <option value="90" {{ request('range') == 90 ? 'selected' : '' }}>Last 3 Months</option>
    </select>

    <button class="bg-blue-500 text-white px-4 py-2 rounded">Apply</button>
</form>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Analytics Structure</h1>

    <div class="grid grid-cols-4 gap-6 mb-6">
        <div class="bg-gray-100 p-4 rounded-lg shadow">
            <h2 class="text-xl font-bold">{{ $totalOrders }}</h2>
            <p>Total Orders</p>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg shadow">
            <h2 class="text-xl font-bold">${{ $totalRevenue }}</h2>
            <p>Total Revenue</p>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg shadow">
            <h2 class="text-xl font-bold">{{ $delivered }}</h2>
            <p>Delivered</p>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg shadow">
            <h2 class="text-xl font-bold">{{ $pending }}</h2>
            <p>Pending</p>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-6">
        <div class="bg-gray-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Orders Last 6 Months</h3>
            <canvas id="ordersChart"></canvas>
        </div>

        <div class="bg-gray-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Top 5 Foods</h3>
            <canvas id="topFoodsChart"></canvas>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ordersCtx = document.getElementById('ordersChart').getContext('2d');
    const ordersChart = new Chart(ordersCtx, {
        type: 'line',
        data: {
        labels: @json($ordersChart->pluck('date')),
        data: @json($ordersChart->pluck('total')),
            datasets: [{
                label: 'Orders',
                data: @json($ordersChart->pluck('total')),
                backgroundColor: 'rgba(79, 70, 229, 0.2)',
                borderColor: 'rgba(79, 70, 229, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.3
            }]
        }
    });

    const topFoodsCtx = document.getElementById('topFoodsChart').getContext('2d');
    const topFoodsChart = new Chart(topFoodsCtx, {
        type: 'bar',
        data: {
            labels: @json($topFoods->pluck('name')),
            datasets: [{
                label: 'Orders',
                data: @json($topFoods->pluck('orders_count')),
                backgroundColor: 'rgba(34, 197, 94, 0.7)',
                borderColor: 'rgba(34, 197, 94, 1)',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y'
        }
    });

    setInterval(() => {
    const params = new URLSearchParams(window.location.search);
    window.location.href = window.location.pathname + '?' + params.toString();
}, 30000);

//     setInterval(() => {
//     location.reload();
// }, 30000); // refresh every 30 seconds
</script>
@endsection
