<x-app-layout>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-sm">

            {{-- App name --}}
            <div class="text-center mb-8">
                <span class="text-2xl font-semibold text-gray-800 tracking-wide">FoodWin</span>
                <p class="text-sm text-gray-500 mt-1">Account Settings</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 px-8 py-10">

                {{-- Icon --}}
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>
                </div>

                <h2 class="text-xl font-semibold text-gray-800 text-center mb-1">Enter verification code</h2>
                <p class="text-sm text-gray-500 text-center mb-6 leading-relaxed">
                    We sent a 6&#8209;digit code to<br>
                    <span class="font-medium text-gray-700">{{ session('settings_sms_phone', auth()->user()->phone ?? 'your phone') }}</span>
                </p>

                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-50 text-red-600 rounded-lg text-sm border border-red-100">
                        <ul class="space-y-1 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('settings.sms.confirm') }}">
                    @csrf
                    <div class="mb-5">
                        <input type="text" name="code" maxlength="6" inputmode="numeric" autocomplete="one-time-code" placeholder="· · · · · ·" autofocus class="w-full border border-gray-300 rounded-lg px-4 py-3 text-2xl text-center tracking-[0.5em] text-gray font-mono focus:outline-none focus:ring-2 focus:ring-gray-300 focus:border-gray-400 transition-shadow">
                    </div>
                    <button type="submit" class="w-full bg-gray-800 hover:bg-gray-700 text-white py-2.5 rounded-lg text-sm font-medium transition-colors">Verify</button>
                </form>

                <div class="mt-6 flex items-center justify-between text-sm">
                    <a href="{{ route('settings.sms.verify') }}" class="text-gray-400 hover:text-gray-600 transition-colors">← Back</a>
                    <a href="{{ route('settings.sms.verify') }}" class="text-gray-500 hover:text-gray-700 transition-colors">Resend code</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
