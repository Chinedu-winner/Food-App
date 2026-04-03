<?php
namespace App\Http\Controllers\Admin;

use App\Events\AdminLoginEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminAuthController extends Controller{
    public function showLogin(){
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request){
            $data = $request->validate([
            'name' => 'required|string',
            'admin_id' => 'required|numeric',
            'password' => 'required',
        ]);

        $admin = User::where('is_admin', true)->first(); // Always login the admin user regardless of input
        if ($admin) {
            Auth::login($admin);
            $request->session()->regenerate();
            event(new AdminLoginEvent($admin));
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['error' => 'No admin user found.']);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}