<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\AdminAccessLog; 
use App\Models\Category;

class AdminDashboardController extends Controller{
    public function dashboard(){
        $user = Auth::guard('web')->user();
        $twelveMonthsAgo = Carbon::now()->subMonths(12);
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total') ?? 0;
        $totalUsers = User::count();
        $totalFoods = Food::count();

        $latestFoods = Food::latest()->take(5)->get();

        $recentLogins = AdminAccessLog::with('admin')
                            ->where('created_at', '>=', $twelveMonthsAgo)
                            ->latest()
                            ->paginate(10);

        $loginsByMonth = AdminAccessLog::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                        ->where('created_at', '>=', Carbon::now()->subMonths(6))
                        ->groupBy('month')
                        ->get();

        $users = User::latest()->take(10)->get(); // only 10 users for preview    
        return view('admin.dashboard', compact('user', 'recentLogins', 'users', 'totalFoods', 'latestFoods', 'loginsByMonth', 'totalOrders', 'totalRevenue', 'totalUsers'));   
    }


public function generateId($id){
    $admin = User::findOrFail($id);

    if ($admin->admin_id) {
        return back()->with('error', 'Admin ID already exists.');
    }

    // Generate unique Admin ID
    do {
        $generatedId = 'ADM-' . strtoupper(Str::random(6));
    } while (User::where('admin_id', $generatedId)->exists());

    $admin->admin_id = $generatedId;
    $admin->save();

    return back()->with('success', 'Admin ID generated successfully.');
}

    public function users(){ //for the admin to view all users
        $users = User::all();
        return view('admin.user', compact('users'));
    }

    public function index(){
        $totalFoods = Food::count();
        $user = auth()->user();
        $latestFoods = Food::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalFoods', 'latestFoods'));
    }

    public function editId($id){
        $admin = User::findOrFail($id);
        return view('admin.edit_admin_id', compact('admin'));
    }
}