<?php

namespace App\Http\Controllers\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialController extends Controller{
    public function redirectToProvider(){
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback(){
        try{
            $userSocial = Socialite::driver('google')->user();
            $email = $userSocial->getEmail();
            
            if (!$email) {
                return redirect('/login')->with('error', 'Email is required for login');
            }
            
            $user = User::updateOrCreate([
                'email' => $email,
            ],
            [
                'name' => $userSocial->getName(),
                'password' => bcrypt('password'),
            ]);
            Auth::login($user, true);
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
        dd(config('services.google'));
    }   
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    dd([
        'env' => env('GOOGLE_CLIENT_ID'),
        'config' => config('services.google'),
    ]);
}}

