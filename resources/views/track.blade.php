@extends('layout')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">

    <div class="max-w-4xl mx-auto px-6">

        <h1 class="text-4xl font-semibold text-gray-800 mb-8 text-center">
            Order Tracking
        </h1>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-300 text-red-700 px-5 py-4 rounded-lg mb-6 shadow-sm">
                @foreach ($errors->all() as $error)
                    <p class="text-sm">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Form --}}
        <div class="bg-white border border-gray-200 p-8 rounded-xl shadow-md mb-8 max-w-lg mx-auto">

            <form method="POST" action="{{ route('track') }}">
                @csrf

                <label for="order_id" class="block text-gray-600 text-sm font-medium mb-2">
                    Order ID
                </label>

                <input
                    type="number"
                    id="order_id"
                    name="order_id"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    placeholder="Enter your order ID"
                    required
                >

                <button
                    type="submit"
                    class="w-full mt-5 bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200 shadow-sm"
                >
                    Track Order
                </button>
            </form>
        </div>

        {{-- Map --}}
        <div class="bg-white border border-gray-200 p-4 rounded-xl shadow-md">
            <div id="map" class="w-full h-96 rounded-lg"></div>
        </div>

    </div>

</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    var defaultLat = 6.5244;
    var defaultLng = 3.3792;

    @isset($order)
        var orderLat = {{ $order->latitude ?? 'null' }};
        var orderLng = {{ $order->longitude ?? 'null' }};
    @else
        var orderLat = null;
        var orderLng = null;
    @endisset

    var mapLat = orderLat ?? defaultLat;
    var mapLng = orderLng ?? defaultLng;

    var map = L.map('map').setView([mapLat, mapLng], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    @isset($order)
    if (orderLat && orderLng) {

        var arrowIcon = L.divIcon({
            className: '',
            html: `
                <div style="display:flex;flex-direction:column;align-items:center;">
                    <div style="font-size:48px;animation:bounce 0.8s infinite alternate;filter:drop-shadow(0 4px 6px rgba(0,0,0,0.3));">📍</div>
                    <div style="background:#2563eb;color:white;padding:5px 12px;border-radius:20px;font-size:12px;font-weight:600;white-space:nowrap;box-shadow:0 2px 5px rgba(0,0,0,0.2);">
                        Order #{{ $order->id }} location
                    </div>
                </div>`,
            iconSize: [150, 80],
            iconAnchor: [75, 70],
        });

        var style = document.createElement('style');
        style.innerHTML = `
            @keyframes bounce {
                from { transform: translateY(0px); }
                to   { transform: translateY(-12px); }
            }
        `;
        document.head.appendChild(style);

        L.marker([orderLat, orderLng], { icon: arrowIcon })
            .addTo(map)
            .bindPopup(`
                <div style="text-align:center;padding:6px;">
                    <strong>Order #{{ $order->id }}</strong><br>
                    Status: <span style="color:green;">{{ $order->status }}</span><br>
                    Address: {{ $order->address }}
                </div>
            `)
            .openPopup();

    } else {

        var waitIcon = L.divIcon({
            className: '',
            html: `
                <div style="text-align:center;">
                    <div style="font-size:38px;">⏳</div>
                    <div style="background:#f59e0b;color:white;padding:4px 10px;border-radius:20px;font-size:12px;font-weight:600;">
                        Locating order...
                    </div>
                </div>`,
            iconSize: [140, 70],
            iconAnchor: [70, 60],
        });

        L.marker([defaultLat, defaultLng], { icon: waitIcon })
            .addTo(map)
            .bindPopup("Order #{{ $order->id }} location updating soon...")
            .openPopup();
    }
    @endisset
</script>
@endsection