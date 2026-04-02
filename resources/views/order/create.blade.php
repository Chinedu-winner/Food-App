@extends('layouts.dashboard') {{-- or whatever your layout is --}}
<form method="GET" action="{{ route('orders.searchFood') }}" class="mb-4">
    <input type="text" name="query" placeholder="Search for food..." class="border p-2 rounded w-80">
    <button type="submit" class="bg-green-500 text-white p-2 rounded">Search</button>
</form>

<div id="search-results">
    @if(isset($foods))
        @foreach($foods as $food)
            <div class="p-4 border rounded mb-2 flex justify-between items-center">
                <div>
                    <h3 class="font-bold">{{ $food->name }}</h3>
                    <p>{{ $food->description }}</p>
                    <p class="text-sm text-gray-500">Price: ${{ $food->price }}</p>
                </div>
                <form method="POST" action="{{ route('orders.addItem', $food->id) }}">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Add to Order</button>
                </form>
            </div>
        @endforeach
    @endif
</div>