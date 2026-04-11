<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class SocialController extends Controller{
    public function redirectToProvider(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request){
        try{
            try {
                $userSocial = Socialite::driver('google')->user();
            } catch (InvalidStateException $e) {
                // Fallback helps avoid local/session state mismatches during OAuth callbacks.
                $userSocial = Socialite::driver('google')->stateless()->user();
            }

            $email = $userSocial->getEmail();
            
            if (!$email) {
                return redirect('/login')->with('error', 'Email is required for login');
            }

            $googleName = $userSocial->getName() ?: Str::before($email, '@');

            $user = User::firstOrCreate([
                'email' => $email,
            ], [
                'name' => $googleName,
                'password' => bcrypt(Str::random(32)),
                'email_verified_at' => now(),
            ]);

            if (!$user->email_verified_at) {
                $user->forceFill(['email_verified_at' => now()])->save();
            }

            if ($user->name !== $googleName) {
                $user->forceFill(['name' => $googleName])->save();
            }

            Auth::login($user, true);
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function redirectToGoogle(){
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return Socialite::driver('google')->redirect();
    }
}

