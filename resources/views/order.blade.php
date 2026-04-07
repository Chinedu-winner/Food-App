<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script src="https://cdn.tailwindcss.com"></script>
<title>Order Page</title>
</head>

<body class="bg-gray-100 text-gray-800 p-6 lg:p-8 min-h-screen">
    <div class="max-w-7xl mx-auto space-y-8">
        <div class="flex items-center justify-between gap-4 flex-wrap">
            <h1 class="text-3xl font-bold">Orders</h1>
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-white rounded-lg shadow text-gray-700 hover:bg-gray-50">Back to Dashboard</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1 bg-white p-6 rounded-xl shadow-lg">
                <h2 class="text-xl font-semibold mb-4">Create New Order</h2>

                @if(session('success'))
                    <div class="mb-4 px-3 py-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
                @endif

                <form action="{{ route('order') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <input type="text" name="name" placeholder="Your Name" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400" required>
                    </div>

                    <div>
                        <input type="text" name="food_name" placeholder="Food Name" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400" required>
                    </div>

                    <div>
                        <input type="number" name="quantity" min="1" placeholder="Quantity" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400" required>
                    </div>

                    <div>
                        <input type="number" step="0.01" min="0" name="price" placeholder="Price" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400" required>
                    </div>

                    <button type="submit" class="w-full bg-yellow-400 text-gray-800 py-3 rounded-lg hover:bg-yellow-500 font-semibold transition-colors">Order Now</button>
                </form>
            </div>

            <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg space-y-6">
                <h2 class="text-xl font-semibold">Filter Orders</h2>

                <form method="GET" action="{{ route('order') }}" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by ID or status" class="px-4 py-2 border border-gray-300 rounded-lg">

                    <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="all" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>All statuses</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="canceled" {{ request('status') === 'canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>

                    <input type="date" name="from_date" value="{{ request('from_date') }}" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <input type="date" name="to_date" value="{{ request('to_date') }}" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <input type="number" step="0.01" min="0" name="min_total" value="{{ request('min_total') }}" placeholder="Min total" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <input type="number" step="0.01" min="0" name="max_total" value="{{ request('max_total') }}" placeholder="Max total" class="px-4 py-2 border border-gray-300 rounded-lg">

                    <div class="md:col-span-2 xl:col-span-3 flex gap-3">
                        <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Apply Filters</button>
                        <a href="{{ route('order') }}" class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Reset</a>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-separate border-spacing-y-2">
                        <thead>
                            <tr class="text-sm text-gray-500">
                                <th class="py-2">Order ID</th>
                                <th class="py-2">Status</th>
                                <th class="py-2">Total</th>
                                <th class="py-2">Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(($orders ?? collect()) as $order)
                                <tr class="bg-gray-50 shadow-sm rounded-lg">
                                    <td class="py-3 px-2 font-medium">#{{ $order->id }}</td>
                                    <td class="py-3 px-2 capitalize">{{ $order->status }}</td>
                                    <td class="py-3 px-2">${{ number_format((float) ($order->total ?? $order->total_price ?? 0), 2) }}</td>
                                    <td class="py-3 px-2">{{ optional($order->created_at)->format('M d, Y h:i A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-gray-500">No orders found for the selected filters.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(isset($orders) && method_exists($orders, 'links'))
                    <div class="pt-2">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>