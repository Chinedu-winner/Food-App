<?php
namespace App\Http\Controllers;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class DashboardController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();

        $totalOrders = Order::where('user_id', $user->id)->count();

        $totalMeals = Food::count();
        $totalRevenue = Order::where('user_id', $user->id)->sum('total');

        $delivered = Order::where('user_id', $user->id)
            ->where('status', 'delivered')
            ->count();

        $pending = Order::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        $weeklyOrders = [];
        for ($i = 6; $i >= 0; $i--) {
            $weeklyOrders[] = Order::where('user_id', $user->id)
                ->whereDate('created_at', now()->subDays($i))
                ->count();
        }

        $produced = Order::where('user_id', $user->id)
            ->where('status', 'preparing')
            ->count();

        $ordered = Order::where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->count();

        return view('dashboard', compact(
            'user',
            'totalOrders',
            'totalRevenue',
            'delivered',
            'pending',
            'weeklyOrders',
            'produced',
            'ordered',
            'totalMeals'
        ));
    }
}