@extends('admin.admin')
@section('page-title', 'Order Management')
@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">All Orders</h1>
</div>

<table class="min-w-full" style="background-color: rgb(233,226,207)" class="border border-gray-200">
    <thead>
        <tr class="bg-gray-100 text-left">
            <th class="py-3 px-4 border-b">ID</th>
            <th class="py-3 px-4 border-b">Customer</th>
            <th class="py-3 px-4 border-b">Food Item</th>
            <th class="py-3 px-4 border-b">Total Price</th>
            <th class="py-3 px-4 border-b">Status</th>
            <th class="py-3 px-4 border-b">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        @php
            $foodSummary = $order->orderItems->map(function ($item) {
                $foodName = $item->food->name ?? 'Unknown food';
                return $foodName . ' (x' . $item->quantity . ')';
            })->join(', ');
        @endphp
        <tr class="hover:bg-gray-50">
            <td class="py-3 px-4 border-b">#{{ $order->id }}</td>
            <td class="py-3 px-4 border-b">{{ $order->user->name ?? $order->name ?? 'Unknown customer' }}</td>
            <td class="py-3 px-4 border-b">{{ $foodSummary ?: (($order->food_name ?? 'No food item') . (isset($order->quantity) ? ' (x' . $order->quantity . ')' : '')) }}</td>
            <td class="py-3 px-4 border-b">${{ number_format((float)($order->total ?? $order->total_price ?? 0), 2) }}</td>
            <td class="py-3 px-4 border-b uppercase font-semibold text-sm">{{ $order->status }}</td>
            <td class="py-3 px-4 border-b space-x-2">
                <a href="{{ route('orders.show', $order->id) }}" class="text-blue-600 hover:underline">View</a>
                <a href="{{ route('admin.orders.track', $order->id) }}" class="text-green-600 hover:underline">Track</a>
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection