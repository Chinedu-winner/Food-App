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
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                </div>

                <h2 class="text-xl font-semibold text-gray-800 text-center mb-1">Add phone number</h2>
                <p class="text-sm text-gray-500 text-center mb-6 leading-relaxed">
                    Enter your phone number to receive a 6&#8209;digit verification code via SMS.
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

                @if(session('message'))
                    <div class="mb-4 p-3 bg-blue-50 text-blue-700 rounded-lg text-sm border border-blue-100">
                        {{ session('message') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('settings.sms.send') }}">
                    @csrf
                    <div class="mb-5">
                        <label class="block text-xs font-medium text-gray-500 mb-1.5 uppercase tracking-wide">
                            Phone number
                        </label>
                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone', auth()->user()->phone) }}"
                            placeholder="+1 234 567 8901"
                            autofocus
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:border-gray-400 transition-shadow"
                        >
                    </div>
                    <button type="submit"
                        class="w-full bg-gray-800 hover:bg-gray-700 text-white py-2.5 rounded-lg text-sm font-medium transition-colors">
                        Send code
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('settings.edit') }}" class="text-sm text-gray-400 hover:text-gray-600 transition-colors">
                        ← Back to Settings
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
