<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Profile') }}
            </h2>
            <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Profile
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Profile Overview Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <span class="text-2xl font-bold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    </div>
                                </div>
                                <div class="ml-6">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ $user->name }}</h3>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                                    @if($user->phone)
                                        <p class="text-sm text-gray-500 dark:text-gray-500 mt-1">{{ $user->phone }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                                    </svg>
                                    Member since {{ $user->created_at->format('M Y') }}
                                </div>
                                @if($user->email_verified_at)
                                    <div class="flex items-center text-sm text-green-600 dark:text-green-400 mt-2">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Email verified
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Details -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Personal Information -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Personal Information</h3>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $user->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email Address</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $user->email }}</dd>
                                </div>
                                @if($user->phone)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Phone Number</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $user->phone }}</dd>
                                </div>
                                @endif
                                @if($user->date_of_birth)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date of Birth</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $user->date_of_birth->format('M j, Y') }}</dd>
                                </div>
                                @endif
                            </dl>
                        </div>
                    </div>

                    <!-- Address Information -->
                    @if($user->address || $user->city || $user->zip_code)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Address Information</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                @if($user->address)
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-900 dark:text-gray-100">{{ $user->address }}</p>
                                            @if($user->city || $user->zip_code)
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    {{ collect([$user->city, $user->zip_code])->filter()->join(', ') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Dietary Preferences -->
                    @if($user->preferences && count($user->preferences) > 0)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center">
                                <svg class="w-5 h-5 mr-3 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                Dietary Preferences
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-wrap gap-2">
                                @foreach($user->preferences as $preference)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                                        {{ $preference }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Account Actions -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Account Actions</h3>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200 text-sm font-medium">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit Profile
                                </a>
                                <a href="{{ route('password.request') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors duration-200 text-sm font-medium">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                    </svg>
                                    Change Password
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
