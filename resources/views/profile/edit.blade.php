<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile Settings</h2>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-100 text-gray-700 rounded-lg text-sm font-medium border border-gray-200 shadow-sm">Back to Dashboard</a>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white rounded-2xl p-6 text-gray-800 shadow-lg border border-gray-200">
                <p class="text-sm uppercase tracking-wider text-gray-500">Account Center</p>
                <h1 class="text-3xl font-bold mt-2">Manage your profile and security</h1>
                <p class="text-gray-600 mt-1">Update your photo, personal details, password, and account preferences from one place.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                        @include('profile.partials.update-password-form')
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                        @include('profile.partials.delete-user-form') 
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>