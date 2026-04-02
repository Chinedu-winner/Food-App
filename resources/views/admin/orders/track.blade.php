@extends('admin.admin')

@section('page-title', 'Track Order')

@section('content')
<h1 class="text-2xl font-bold mb-4">Tracking Order #{{ $order->id ?? 'N/A' }}</h1>

@if($order)
    <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
        <div class="max-w-md mx-auto">
            <div class="text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                <p>Current Status: <span class="font-bold text-orange-600 uppercase">{{ $order->status }}</span></p>
                <p>Last Updated: {{ $order->updated_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>
@else
    <p class="text-red-500">Order not found for tracking.</p>
@endif
@endsection 