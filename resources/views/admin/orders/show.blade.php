@extends('admin.admin')
@section('page-title', 'Order Details')
@section('content')

<div class="mb-6">
    <a href="{{ route('admin.orders') }}" class="text-blue-500">&larr; Back to Orders</a>
</div>

<div class="bg-gray-50 p-6 rounded-lg border">
    <h2 class="text-xl font-bold mb-4">Order #{{ $order->id }} Details</h2>
    <div class="grid grid-cols-2 gap-4">
        <div> 
            <p class="text-gray-600">Customer Name:</p>
            <p class="font-semibold">{{ $order->name }}</p>
        </div>
        <div>
            <p class="text-gray-600">Delivery Address:</p>
            <p class="font-semibold">{{ $order->address }}</p>
        </div>
        <div>
            <p class="text-gray-600">Order Status:</p>
            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-bold uppercase">{{ $order->status }}</span>
        </div>
    </div>
</div>
@endsection