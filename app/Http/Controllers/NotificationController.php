<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller{
    public function edit(){
        $user = Auth::user();
        return view('settings.notifications', compact('user'));
    }

    public function update(Request $request){
        $user = Auth::user();

        // Example notification settings: email and sms
        $request->validate([
            'email_notifications' => 'nullable|boolean',
            'sms_notifications' => 'nullable|boolean',
        ]);

        $user->email_notifications = $request->has('email_notifications');
        $user->sms_notifications = $request->has('sms_notifications');
        $user->save();

        return redirect()->route('settings.notifications')->with('success', 'Notification settings updated!');
    }
}