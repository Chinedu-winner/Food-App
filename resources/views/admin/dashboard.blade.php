@extends('admin.admin')
@section('page-title', 'Dashboard Overview')

@section('content')
    <div class="flex justify-between items-center mb-8">

        <h1 class="text-3xl font-bold">Dashboard Overview</h1>

        <div class="text-gray-600">Welcome {{ Auth::user()->name }}</div>

    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-500">Total Orders</h3>
            <p class="text-2xl font-bold">85</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-500">Restaurants</h3>
            <p class="text-2xl font-bold">15</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-500">Revenue</h3>
            <p class="text-2xl font-bold">₦450,000</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-500">Users</h3>
            <p class="text-2xl font-bold">120</p>
        </div>
    </div>
    
    <div class="recent-logins mt-6">
    <h3 class="font-semibold mb-2">Admin Logins</h3>

    <table class="w-full mt-6 text-left border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">IP Address</th>
                <th class="p-2 border">Device</th>
                <th class="p-2 border">Date & Time</th>
            </tr>
        </thead>
        <tbody>
    @if(isset($recentLogins) && $recentLogins->count())
        @foreach($recentLogins as $log)
            <tr>
                <td class="p-2 border">{{ $log->admin->name }}</td>
                <td class="p-2 border">{{ $log->admin->email }}</td>
                <td class="p-2 border">{{ $log->ip_address }}</td>
                <td class="p-2 border">{{ $log->device }}</td>
                <td class="p-2 border">{{ $log->created_at->format('d M Y H:i') }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td class="p-2 border text-center" colspan="5">No logins found.</td>
        </tr>
    @endif
</tbody>
    </table>

    <h2>Recent Users</h2>
    <table class="w-full mt-6 text-left border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">Date & Time</th>

            </tr>
        </thead>

        @foreach($users as $user)
            <tr>
                <td class="p-2 border">{{ $user->name }}</td>
                <td class="p-2 border">{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d M Y H:i') }}</td>
            </tr>
        @endforeach
    </table>

    <div class="bg-white p-6 rounded-xl shadow">
    <h2 class="text-gray-500">Total Foods</h2>
    <p class="text-3xl font-bold">{{ $totalFoods }}</p> 
    </div>

    @foreach($latestFoods as $food)
    <div class="border-b py-2">
        <p class="font-semibold">{{ $food->name }}</p>
        <small class="text-gray-500">
            Added {{ $food->created_at->diffForHumans() }}
        </small>
    </div>
    @endforeach

    <a href="{{ route('admin.users') }}">
        <button>See More</button>
    </a>
        {{ $recentLogins->links() }}
    </div>

    <div class="bg-white rounded shadow p-6">

        <h2 class="text-xl font-semibold mb-4">Recent Orders</h2>

        <table class="w-full text-left border">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Order ID</th>
                    <th class="p-3">Customer</th>
                    <th class="p-3">Food</th>
                    <th class="p-3">Amount</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-t">
                    <td class="p-3">#101</td>
                    <td class="p-3">John Doe</td>
                    <td class="p-3">Pizza</td>
                    <td class="p-3">₦5000</td>
                    <td class="p-3 text-yellow-600">Pending</td>
                </tr>
                <tr class="border-t">
                    <td class="p-3">#102</td>
                    <td class="p-3">Mary Smith</td>
                    <td class="p-3">Burger</td>
                    <td class="p-3">₦3500</td>
                    <td class="p-3 text-green-600">Completed</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
<script>
    let idleTime = 0;

    let idleInterval = setInterval(timerIncrement, 60000); 

    document.onmousemove = document.onkeypress = function() {
        idleTime = 0;
    };

    function timerIncrement() {
        idleTime++;
        if (idleTime > 5) {
            alert("You have been logged out due to inactivity.");
            window.location.href = "{{ route('admin.login') }}";
        }
    }
</script>
@endpush