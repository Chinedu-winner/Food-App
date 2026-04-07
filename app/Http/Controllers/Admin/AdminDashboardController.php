<?php
namespace App\Http\Controllers\Admin;
use App\Models\Food;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\AdminAccessLog; 
use App\Models\Category;

class AdminDashboardController extends Controller{
    public function __construct(){
        $this->middleware(['admin']); 
    }

    public function dashboard(){
        $user = auth()->user();
            $twelveMonthsAgo = Carbon::now()->subMonths(12);
    
                $latestFoods = Food::latest()->take(5)->get(); 

                $totalFoods = Food::count(); 

        $recentLogins = AdminAccessLog::with('admin')
                            ->where('created_at', '>=', $twelveMonthsAgo)
                            ->latest()
                            ->paginate(10);

        $loginsByMonth = AdminAccessLog::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                        ->where('created_at', '>=', Carbon::now()->subMonths(6))
                        ->groupBy('month')
                        ->get();

    $users = User::latest()->take(10)->get(); // only 10 users for preview    
        return view('admin.dashboard', compact('user', 'recentLogins', 'users', 'totalFoods', 'latestFoods', 'loginsByMonth'
    ));   
}


    public function users(){ //fOR the admin to view all users
        $users = User::all();
        return view('admin.user', compact('users'));
    }

public function index(){
    $totalFoods = Food::count();
    $user = auth()->user();
    $latestFoods = Food::latest()->take(5)->get();

    return view('admin.dashboard', compact('totalFoods', 'latestFoods'));
}
}