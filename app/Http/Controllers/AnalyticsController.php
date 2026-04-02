<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Food;

class AnalyticsController extends Controller{
    public function index(){
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        $delivered = Order::where('status', 'delivered')->count();
        $pending = Order::where('status', 'pending')->count();

        $topFoods = Food::withCount('orders')
                        ->orderBy('orders_count', 'desc')
                        ->take(5)
                        ->get();

    $range = request('range', 30);
        $startDate = now()->subDays($range);
        $totalOrders = Order::where('created_at', '>=', $startDate)->count();
        $totalRevenue = Order::where('created_at', '>=', $startDate)->sum('total_price');
        $monthlyOrders = Order::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

    $monthlyOrders = Order::selectRaw('MONTH(created_at) as month_number, MONTHNAME(created_at) as month, COUNT(*) as total')
        ->where('created_at', '>=', now()->subMonths(6))
        ->groupBy('month_number', 'month')
        ->orderBy('month_number')
        ->get();

        return view('analytics', compact(
            'totalOrders', 'totalRevenue', 'delivered', 'pending', 'topFoods', 'monthlyOrders'
        ));
    }
}