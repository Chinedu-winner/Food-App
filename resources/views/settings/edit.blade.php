<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Settings</h2>
    </x-slot>

    @php
        $defaults = [
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
        $appSettings = array_merge($defaults, $user->preferences['app_settings'] ?? []);
    @endphp

    <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto space-y-12">

            @if(session('message'))
                <div class="p-3 bg-blue-100 text-blue-800 rounded-md border border-blue-200">{{ session('message') }}</div>
            @endif

            @if(session('success'))
                <div class="p-3 bg-green-100 text-green-800 rounded-md border border-green-200">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="p-3 bg-red-100 text-red-700 rounded-md border border-red-200">
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section class="bg-white rounded-xl p-8 shadow-lg space-y-6 border border-gray-200">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">Application Settings</h3>
                    <p class="text-sm text-gray-500 mt-1">General Users, Food & Categories, Orders, Payments, Delivery, Notifications, Security, and System.</p>
                </div>

                <form method="POST" action="{{ route('settings.app.update') }}" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">General Users: Language</label>
                            <select name="settings[language]" class="w-full rounded-md p-2 bg-gray-50 border border-gray-300 text-gray-800 focus:ring-2 focus:ring-gray-300 focus:border-gray-400">
                                <option value="en" {{ $appSettings['language'] === 'en' ? 'selected' : '' }}>English</option>
                                <option value="fr" {{ $appSettings['language'] === 'fr' ? 'selected' : '' }}>French</option>
                                <option value="es" {{ $appSettings['language'] === 'es' ? 'selected' : '' }}>Spanish</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">General Users: Timezone</label>
                            <input type="text" name="settings[timezone]" value="{{ old('settings.timezone', $appSettings['timezone']) }}" class="w-full rounded-md p-2 bg-gray-50 border border-gray-300 text-gray-800 focus:ring-2 focus:ring-gray-300 focus:border-gray-400">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="flex items-center justify-between p-3 rounded-lg border border-gray-200 bg-gray-50">
                            <span class="text-sm text-gray-700">Food & Categories: Enable Categories</span>
                            <input type="checkbox" name="settings[food_categories_enabled]" value="1" class="h-5 w-5 text-gray-700" {{ $appSettings['food_categories_enabled'] ? 'checked' : '' }}>
                        </label>
                        <label class="flex items-center justify-between p-3 rounded-lg border border-gray-200 bg-gray-50">
                            <span class="text-sm text-gray-700">Food & Categories: Show Out-of-Stock Items</span>
                            <input type="checkbox" name="settings[show_out_of_stock_food]" value="1" class="h-5 w-5 text-gray-700" {{ $appSettings['show_out_of_stock_food'] ? 'checked' : '' }}>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="flex items-center justify-between p-3 rounded-lg border border-gray-200 bg-gray-50">
                            <span class="text-sm text-gray-700">Orders: Auto Confirm Orders</span>
                            <input type="checkbox" name="settings[order_auto_confirm]" value="1" class="h-5 w-5 text-gray-700" {{ $appSettings['order_auto_confirm'] ? 'checked' : '' }}>
                        </label>
                        <label class="flex items-center justify-between p-3 rounded-lg border border-gray-200 bg-gray-50">
                            <span class="text-sm text-gray-700">Orders: Allow Cancellation</span>
                            <input type="checkbox" name="settings[allow_order_cancellation]" value="1" class="h-5 w-5 text-gray-700" {{ $appSettings['allow_order_cancellation'] ? 'checked' : '' }}>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Payments: Default Method</label>
                            <select name="settings[payment_method]" class="w-full rounded-md p-2 bg-gray-50 border border-gray-300 text-gray-800 focus:ring-2 focus:ring-gray-300 focus:border-gray-400">
                                <option value="card" {{ $appSettings['payment_method'] === 'card' ? 'selected' : '' }}>Card</option>
                                <option value="bank_transfer" {{ $appSettings['payment_method'] === 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="cash_on_delivery" {{ $appSettings['payment_method'] === 'cash_on_delivery' ? 'selected' : '' }}>Cash on Delivery</option>
                            </select>
                        </div>
                        <label class="flex items-center justify-between p-3 rounded-lg border border-gray-200 bg-gray-50 mt-6 md:mt-0">
                            <span class="text-sm text-gray-700">Payments: Save Payment Method</span>
                            <input type="checkbox" name="settings[save_payment_method]" value="1" class="h-5 w-5 text-gray-700" {{ $appSettings['save_payment_method'] ? 'checked' : '' }}>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="flex items-center justify-between p-3 rounded-lg border border-gray-200 bg-gray-50">
                            <span class="text-sm text-gray-700">Delivery: Contactless Delivery</span>
                            <input type="checkbox" name="settings[contactless_delivery]" value="1" class="h-5 w-5 text-gray-700" {{ $appSettings['contactless_delivery'] ? 'checked' : '' }}>
                        </label>
                        <label class="flex items-center justify-between p-3 rounded-lg border border-gray-200 bg-gray-50">
                            <span class="text-sm text-gray-700">Delivery: Enable Delivery Notes</span>
                            <input type="checkbox" name="settings[delivery_notes_enabled]" value="1" class="h-5 w-5 text-gray-700" {{ $appSettings['delivery_notes_enabled'] ? 'checked' : '' }}
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="flex items-center justify-between p-3 rounded-lg border border-gray-200 bg-gray-50">
                            <span class="text-sm text-gray-700">Notifications: Email</span>
                            <input type="checkbox" name="settings[notify_email]" value="1" class="h-5 w-5 text-gray-700" {{ $appSettings['notify_email'] ? 'checked' : '' }}>
                        </label>
                        <label class="flex items-center justify-between p-3 rounded-lg border border-gray-200 bg-gray-50">
                            <span class="text-sm text-gray-700">Notifications: SMS</span>
                            <input type="checkbox" name="settings[notify_sms]" value="1" class="h-5 w-5 text-gray-700" {{ $appSettings['notify_sms'] ? 'checked' : '' }}>
                        </label>
                        <label class="flex items-center justify-between p-3 rounded-lg border border-gray-200 bg-gray-50">
                            <span class="text-sm text-gray-700">Notifications: Push</span>
                            <input type="checkbox" name="settings[notify_push]" value="1" class="h-5 w-5 text-gray-700" {{ $appSettings['notify_push'] ? 'checked' : '' }}>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="flex items-center justify-between p-3 rounded-lg border border-gray-200 bg-gray-50">
                            <span class="text-sm text-gray-700">Security: Enable Two Factor Authentication</span>
                            <input type="checkbox" name="settings[two_factor_auth]" value="1" class="h-5 w-5 text-gray-700" {{ $appSettings['two_factor_auth'] ? 'checked' : '' }}>
                        </label>
                        <label class="flex items-center justify-between p-3 rounded-lg border border-gray-200 bg-gray-50">
                            <span class="text-sm text-gray-700">Security: Login Alerts</span>
                            <input type="checkbox" name="settings[login_alerts]" value="1" class="h-5 w-5 text-gray-700" {{ $appSettings['login_alerts'] ? 'checked' : '' }}>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="flex items-center justify-between p-3 rounded-lg border border-gray-200 bg-gray-50">
                            <span class="text-sm text-gray-700">System: Maintenance Mode Alerts</span>
                            <input type="checkbox" name="settings[maintenance_mode_alerts]" value="1" class="h-5 w-5 text-gray-700" {{ $appSettings['maintenance_mode_alerts'] ? 'checked' : '' }}>
                        </label>
                        <label class="flex items-center justify-between p-3 rounded-lg border border-gray-200 bg-gray-50">
                            <span class="text-sm text-gray-700">System: Weekly Digest Reports</span>
                            <input type="checkbox" name="settings[system_digest_reports]" value="1" class="h-5 w-5 text-gray-700" {{ $appSettings['system_digest_reports'] ? 'checked' : '' }}>
                        </label>
                    </div>

                    <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md">Save Application Settings</button>
                </form>
            </section>

            <!-- PROFILE SECTION -->
            <section class="bg-white rounded-xl p-8 shadow-lg space-y-4 border border-gray-200">
                <h3 class="text-xl font-semibold text-gray-800">Profile</h3>
                @if(session('success_profile'))
                    <div class="p-3 bg-green-600 text-white rounded-md">{{ session('success_profile') }}</div>
                @endif
                <form method="POST" action="{{ route('settings.profile.update') }}" class="space-y-4">
                    @csrf
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Name" class="w-full rounded-md p-2 bg-gray-50 border border-gray-300 text-gray-800 focus:ring-2 focus:ring-gray-300 focus:border-gray-400">
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email" class="w-full rounded-md p-2 bg-gray-50 border border-gray-300 text-gray-800 focus:ring-2 focus:ring-gray-300 focus:border-gray-400">
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Phone" class="w-full rounded-md p-2 bg-gray-50 border border-gray-300 text-gray-800 focus:ring-2 focus:ring-gray-300 focus:border-gray-400">
                    <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md">Update Profile</button>
                </form>
            </section>

            <!-- NOTIFICATIONS SECTION -->
            <section class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-100">
                    <h3 class="text-xl font-semibold text-gray-800">Notifications &amp; Verification</h3>
                    <p class="text-sm text-gray-500 mt-1">Manage how you receive notifications and verify your contact details.</p>
                </div>

                <div class="divide-y divide-gray-100">

                    {{-- Email Notifications Row --}}
                    <div class="flex items-center justify-between px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Email Notifications</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            @if($user->hasVerifiedEmail())
                                <span class="text-xs text-green-600 bg-green-50 border border-green-100 px-2.5 py-1 rounded-full font-medium">Verified</span>
                            @else
                                <span class="text-xs text-amber-600 bg-amber-50 border border-amber-100 px-2.5 py-1 rounded-full font-medium">Not verified</span>
                            @endif
                            {{-- Toggle --}}
                            <form method="POST" action="{{ route('settings.notifications.update') }}" id="form-email-notif">
                                @csrf
                                <input type="hidden" name="sms_notifications" value="{{ $user->sms_notifications ? '1' : '0' }}">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="email_notifications" value="1"
                                        class="sr-only peer"
                                        {{ $user->email_notifications ? 'checked' : '' }}
                                        onchange="document.getElementById('form-email-notif').submit()">
                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-gray-700
                                        after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                        after:bg-white after:border-gray-300 after:border after:rounded-full
                                        after:h-5 after:w-5 after:transition-all
                                        peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                </label>
                            </form>
                            {{-- Verify Email Button --}}
                            <a href="{{ route('settings.email.page') }}"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-gray-300 text-xs font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-400 transition-colors">
                                Verify
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- SMS Notifications Row --}}
                    <div class="flex items-center justify-between px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">SMS Notifications</p>
                                <p class="text-xs text-gray-400 mt-0.5">
                                    {{ $user->phone ? $user->phone : 'No phone number added' }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            @if($user->phone && $user->phone_verified)
                                <span class="text-xs text-green-600 bg-green-50 border border-green-100 px-2.5 py-1 rounded-full font-medium">Verified</span>
                            @elseif($user->phone)
                                <span class="text-xs text-amber-600 bg-amber-50 border border-amber-100 px-2.5 py-1 rounded-full font-medium">Not verified</span>
                            @else
                                <span class="text-xs text-gray-400 bg-gray-50 border border-gray-200 px-2.5 py-1 rounded-full">Add phone</span>
                            @endif
                            {{-- Toggle --}}
                            <form method="POST" action="{{ route('settings.notifications.update') }}" id="form-sms-notif">
                                @csrf
                                <input type="hidden" name="email_notifications" value="{{ $user->email_notifications ? '1' : '0' }}">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="sms_notifications" value="1"
                                        class="sr-only peer"
                                        {{ $user->sms_notifications ? 'checked' : '' }}
                                        onchange="document.getElementById('form-sms-notif').submit()">
                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-gray-700
                                        after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                        after:bg-white after:border-gray-300 after:border after:rounded-full
                                        after:h-5 after:w-5 after:transition-all
                                        peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                </label>
                            </form>
                            {{-- Verify SMS Button --}}
                            <a href="{{ route('settings.sms.verify') }}"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-gray-300 text-xs font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-400 transition-colors">
                                Verify
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>

                @if(session('success_notifications'))
                    <div class="px-8 py-3 bg-green-50 text-green-700 text-sm border-t border-green-100">{{ session('success_notifications') }}</div>
                @endif
            </section>

            <!-- PASSWORD SECTION -->
            <section class="bg-white rounded-xl p-8 shadow-lg space-y-4 border border-gray-200">
                <h3 class="text-xl font-semibold text-gray-800">Change Password</h3>
                @if(session('success_password'))
                    <div class="p-3 bg-green-600 text-white rounded-md">{{ session('success_password') }}</div>
                @endif
                <form method="POST" action="{{ route('settings.password.update') }}" class="space-y-4">
                    @csrf
                    <input type="password" name="current_password" placeholder="Current Password" class="w-full rounded-md p-2 bg-gray-50 border border-gray-300 text-gray-800 focus:ring-2 focus:ring-gray-300 focus:border-gray-400">
                    <input type="password" name="password" placeholder="New Password" class="w-full rounded-md p-2 bg-gray-50 border border-gray-300 text-gray-800 focus:ring-2 focus:ring-gray-300 focus:border-gray-400">
                    <input type="password" name="password_confirmation" placeholder="Confirm New Password" class="w-full rounded-md p-2 bg-gray-50 border border-gray-300 text-gray-800 focus:ring-2 focus:ring-gray-300 focus:border-gray-400">
                    <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md">Update Password</button>
                </form>
            </section>

        </div>
    </div>
</x-app-layout>