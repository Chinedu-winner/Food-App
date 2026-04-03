@extends('layout')

@section('content')
<div class="container mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">Track Your Order</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="bg-gray-50 p-6 rounded shadow mb-6 max-w-md">
        <form method="POST" action="{{ route('track') }}">
            @csrf
            <label for="order_id" class="block text-gray-700 font-semibold mb-2">Enter Your Order ID:</label>
            <input type="number" id="order_id" name="order_id" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"placeholder="Enter order ID"required>
            <button type="submit" class="w-full mt-4 bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Track Order</button>
        </form>
    </div>

    @isset($order)
    <div id="map" class="w-full h-96 rounded shadow"></div>
    @endisset

</div>

@endsection

@section('scripts')
@isset($order)
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>

var orderLat = {{ $order->latitude ?? 6.5244 }};
    var orderLng = {{ $order->longitude ?? 3.3792 }};

    var map = L.map('map').setView([orderLat, orderLng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    L.marker([orderLat, orderLng]).addTo(map)
        .bindPopup("Order Location")
        .openPopup();
</script>
@endisset
@endsection