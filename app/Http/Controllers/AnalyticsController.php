<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Food;

class AnalyticsController extends Controller{
    public function index(Request $request){
    $range = $request->range ?? 30;
    $startDate = now()->subDays($range);
    $totalOrders = Order::where('created_at', '>=', $startDate)->count();
    $totalRevenue = Order::where('created_at', '>=', $startDate)
        ->sum('total_price');

    $delivered = Order::where('status', 'delivered')
        ->where('created_at', '>=', $startDate)
        ->count();

    $pending = Order::where('status', 'pending')
        ->where('created_at', '>=', $startDate)
        ->count();

    $ordersChart = Order::selectRaw('DATE(created_at) as date, COUNT(*) as total')
        ->where('created_at', '>=', $startDate)
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $topFoods = Food::withCount(['orders as orders_count' => function ($query) use ($startDate) {
        $query->where('orders.created_at', '>=', $startDate);
    }])
->orderBy('orders_count', 'desc')
->take(5)
->get();

    return view('analytics', compact(
        'totalOrders',
        'totalRevenue',
        'delivered',
        'pending',
        'ordersChart',
        'topFoods'
    ));
    }
}
