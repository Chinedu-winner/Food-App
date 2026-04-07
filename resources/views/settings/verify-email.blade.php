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
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>

                <h2 class="text-xl font-semibold text-gray-800 text-center mb-1">Verify your email</h2>
                <p class="text-sm text-gray-500 text-center mb-6 leading-relaxed">
                    We'll send a verification link to your email address.
                </p>

                {{-- Current email display --}}
                <div class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 mb-6 flex items-center gap-3">
                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8"/>
                    </svg>
                    <span class="text-sm text-gray-700 truncate">{{ auth()->user()->email }}</span>
                    @if(auth()->user()->hasVerifiedEmail())
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0 ml-auto" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    @endif
                </div>
                @if(session('message'))
                    <div class="mb-4 p-3 bg-blue-50 text-blue-700 rounded-lg text-sm border border-blue-100">
                        {{ session('message') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg text-sm border border-green-100">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-50 text-red-700 rounded-lg text-sm border border-red-100">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if(auth()->user()->hasVerifiedEmail())
                    <div class="flex items-center gap-2 justify-center text-sm text-green-600 font-medium mb-4">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Your email is already verified
                    </div>
                @else
                    <form method="POST" action="{{ route('settings.email.send') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-xs font-medium text-gray-500 mb-1.5 uppercase tracking-wide">Email</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email', auth()->user()->email) }}"
                                required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:border-gray-400"
                            >
                        </div>
                        <button type="submit"
                            class="w-full bg-gray-800 hover:bg-gray-700 text-white py-2.5 rounded-lg text-sm font-medium transition-colors">
                            Send verification email
                        </button>
                    </form>
                @endif

                <div class="mt-6 text-center">
                    <a href="{{ route('settings.edit') }}" class="text-sm text-gray-400 hover:text-gray-600 transition-colors">
                        ← Back to Settings
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
