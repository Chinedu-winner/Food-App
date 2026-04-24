<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SettingsController extends Controller{
    private function defaultAppSettings(): array{
        return [
            'language' => 'en',
            'timezone' => config('app.timezone', 'UTC'),
            'food_categories_enabled' => true,
            'show_out_of_stock_food' => false,
            'order_auto_confirm' => false,
            'allow_order_cancellation' => true,
            'payment_method' => 'card',
            'save_payment_method' => false,
            'contactless_delivery' => false,
            'delivery_notes_enabled' => true,
            'notify_email' => true,
            'notify_sms' => false,
            'notify_push' => false,
            'two_factor_auth' => false,
            'login_alerts' => true,
            'maintenance_mode_alerts' => true,
            'system_digest_reports' => false,
        ];
    }

    public function edit(): View{
        $user = Auth::user();
        return view('settings.edit', compact('user'));
    }

    public function index(): View{
        return $this->edit();
    }

    public function updateProfile(Request $request): RedirectResponse{
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $user->name = $request->string('name');
        $user->email = $request->string('email');
        $user->phone = $request->filled('phone') ? (string) $request->input('phone') : $user->phone;
        $user->save();

        return back()->with('success_profile', 'Profile updated!');
    }

    public function updateNotifications(Request $request): RedirectResponse{
        $user = Auth::user();

        $request->validate([
            'email_notifications' => ['nullable', 'boolean'],
            'sms_notifications' => ['nullable', 'boolean'],
        ]);

        $user->email_notifications = $request->boolean('email_notifications');
        $user->sms_notifications = $request->boolean('sms_notifications');
        $user->save();

        return back()->with('success_notifications', 'Notification settings updated!');
    }

    public function updatePassword(Request $request): RedirectResponse{
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success_password', 'Password updated!');
    }

    public function updateAppSettings(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'settings.language' => ['required', Rule::in(['en', 'fr', 'es'])],
            'settings.timezone' => ['required', 'string', 'max:100'],
            'settings.payment_method' => ['required', Rule::in(['card', 'bank_transfer', 'cash_on_delivery'])],
            'settings.food_categories_enabled' => ['nullable', 'boolean'],
            'settings.show_out_of_stock_food' => ['nullable', 'boolean'],
            'settings.order_auto_confirm' => ['nullable', 'boolean'],
            'settings.allow_order_cancellation' => ['nullable', 'boolean'],
            'settings.save_payment_method' => ['nullable', 'boolean'],
            'settings.contactless_delivery' => ['nullable', 'boolean'],
            'settings.delivery_notes_enabled' => ['nullable', 'boolean'],
            'settings.notify_email' => ['nullable', 'boolean'],
            'settings.notify_sms' => ['nullable', 'boolean'],
            'settings.notify_push' => ['nullable', 'boolean'],
            'settings.two_factor_auth' => ['nullable', 'boolean'],
            'settings.login_alerts' => ['nullable', 'boolean'],
            'settings.maintenance_mode_alerts' => ['nullable', 'boolean'],
            'settings.system_digest_reports' => ['nullable', 'boolean'],
        ]);

        $existingPreferences = $user->preferences ?? [];

        $newSettings = [
            'language' => (string) $request->input('settings.language', 'en'),
            'timezone' => (string) $request->input('settings.timezone', config('app.timezone', 'UTC')),
            'payment_method' => (string) $request->input('settings.payment_method', 'card'),
            'food_categories_enabled' => $request->boolean('settings.food_categories_enabled'),
            'show_out_of_stock_food' => $request->boolean('settings.show_out_of_stock_food'),
            'order_auto_confirm' => $request->boolean('settings.order_auto_confirm'),
            'allow_order_cancellation' => $request->boolean('settings.allow_order_cancellation'),
            'save_payment_method' => $request->boolean('settings.save_payment_method'),
            'contactless_delivery' => $request->boolean('settings.contactless_delivery'),
            'delivery_notes_enabled' => $request->boolean('settings.delivery_notes_enabled'),
            'notify_email' => $request->boolean('settings.notify_email'),
            'notify_sms' => $request->boolean('settings.notify_sms'),
            'notify_push' => $request->boolean('settings.notify_push'),
            'two_factor_auth' => $request->boolean('settings.two_factor_auth'),
            'login_alerts' => $request->boolean('settings.login_alerts'),
            'maintenance_mode_alerts' => $request->boolean('settings.maintenance_mode_alerts'),
            'system_digest_reports' => $request->boolean('settings.system_digest_reports'),
        ];

        $existingPreferences['app_settings'] = array_merge($this->defaultAppSettings(), $newSettings);

        $user->preferences = $existingPreferences;
        $user->save();

        return back()->with('success', 'Application settings updated successfully.');
    }

    public function showEmailVerifyPage(): View{
        return view('settings.verify-email');
    }

    public function sendEmailVerification(): RedirectResponse{
        $user = Auth::user();

        $validated = request()->validate([
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
        ]);

        $newEmail = (string) $validated['email'];

        if ($user->email !== $newEmail) {
            $user->email = $newEmail;
            $user->email_verified_at = null;
            $user->save();
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('settings.email.page')->with('success', 'Your email is already verified.');
        }

        $user->sendEmailVerificationNotification();

        return redirect()->route('settings.email.page')->with('message', 'Verification link sent — check your inbox.');
    }

    public function showSmsForm(): View{
        return view('settings.verify-sms');
    }

    public function showSmsConfirmPage(): View{
        return view('settings.verify-sms-confirm');
    }

    public function sendSmsCode(Request $request): RedirectResponse{
        $request->validate([
            'phone' => ['required', 'string', 'max:20', 'regex:/^[\+]?[0-9\-\(\)\s]+$/'],
        ]);

        $user = Auth::user();
        $user->phone = (string) $request->input('phone');
        $user->save();

        // Generate OTP code (e.g., 6-digit) and keep it in session for verification.
        $code = rand(100000, 999999);
        $request->session()->put('settings_sms_code', (string) $code);
        $request->session()->put('settings_sms_phone', $user->phone);

        // Send SMS via service like Twilio, Nexmo, etc.
        // SMS::send($user->phone, "Your verification code is $code");

        return redirect()->route('settings.sms.code')->with('message', 'Code sent — enter it below.');
    }

    public function confirmSmsCode(Request $request): RedirectResponse{
        $request->validate(['code' => 'required|numeric']);
        $user = Auth::user();
        $sessionCode = (string) $request->session()->get('settings_sms_code', '');

        if ((string) $request->input('code') === $sessionCode && $sessionCode !== '') {
            $user->phone_verified = true;
            $user->sms_notifications = true;
            $user->save();

            $request->session()->forget(['settings_sms_code', 'settings_sms_phone']);

            return redirect()->route('settings.edit')->with('success', 'SMS verified!');
        }

        return back()->withErrors(['code' => 'Invalid verification code.']);
    }

    public function verifyEmail(): RedirectResponse{
        return redirect()->route('settings.email.page');
    }

}