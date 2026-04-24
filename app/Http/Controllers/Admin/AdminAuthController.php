<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminAuthController extends Controller{
    public function showLogin(){
    $user = User::first();

    Auth::login($user);

    request()->session()->regenerate();

    return redirect()->route('admin.dashboard');
}

    public function login(Request $request){
        $user = User::first();

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
