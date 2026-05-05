<section>
    <header>
        <h2 class="text-xl font-semibold text-gray-900">Profile Information</h2>
        <p class="mt-1 text-sm text-gray-600">Update your account details and profile picture.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
            <img id="profile-photo-preview" src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}" class="w-20 h-20 rounded-full object-cover border-2 border-slate-300" alt="Profile photo preview">
            <div class="flex-1">
                <x-input-label for="profile_photo" :value="__('Profile Picture')" />
                <input id="profile-photo-input" name="profile_photo" type="file" accept="image/*" class="mt-2 block w-full text-sm text-gray-700 file:mr-4 file:rounded-md file:border file:border-gray-300 file:bg-white file:px-3 file:py-2 file:text-gray-700 hover:file:bg-gray-100">
                <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full focus:border-gray-500 focus:ring-gray-400" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full focus:border-gray-500 focus:ring-gray-400" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full focus:border-gray-500 focus:ring-gray-400" :value="old('phone', $user->phone)" autocomplete="tel" placeholder="+1 (555) 123-4567" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full focus:border-gray-500 focus:ring-gray-400" :value="old('address', $user->address)" autocomplete="address-line1" placeholder="123 Main Street" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="city" :value="__('City')" />
                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full focus:border-gray-500 focus:ring-gray-400" :value="old('city', $user->city)" autocomplete="address-level2" placeholder="New York" />
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>

            <div>
                <x-input-label for="zip_code" :value="__('Zip Code')" />
                <x-text-input id="zip_code" name="zip_code" type="text" class="mt-1 block w-full focus:border-gray-500 focus:ring-gray-400" :value="old('zip_code', $user->zip_code)" autocomplete="postal-code" placeholder="10001" />
                <x-input-error class="mt-2" :messages="$errors->get('zip_code')" />
            </div>
        </div>

        <div>
            <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
            <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full focus:border-gray-500 focus:ring-gray-400" :value="old('date_of_birth', $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '')" />
            <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
        </div>

        <div>
            <x-input-label :value="__('Dietary Preferences')" />
            <p class="text-sm text-gray-600 mb-3">Select preferences to help with recommendations.</p>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                @php
                    $preferences = old('preferences', $user->preferences ?? []);
                    $availablePreferences = ['Vegetarian', 'Vegan', 'Gluten-Free', 'Dairy-Free', 'Nut-Free', 'Halal', 'Kosher', 'Low-Carb', 'Keto'];
                @endphp
                @foreach($availablePreferences as $preference)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="preferences[]" value="{{ $preference }}" {{ in_array($preference, $preferences) ? 'checked' : '' }} class="rounded border-gray-300 text-gray-700 shadow-sm focus:ring-gray-400">
                        <span class="ml-2 text-sm text-gray-700">{{ $preference }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition ease-in-out duration-150">{{ __('Save Profile Changes') }}</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('profile-photo-input');
    const previewImg = document.getElementById('profile-photo-preview');

    if (!fileInput || !previewImg) {
        return;
    }

    fileInput.addEventListener('change', function (event) {
        const file = event.target.files && event.target.files[0];
        if (!file || !file.type.startsWith('image/')) {
            return;
        }

        const objectUrl = URL.createObjectURL(file);
        previewImg.src = objectUrl;

        previewImg.onload = function () {
            URL.revokeObjectURL(objectUrl);
        };
    });
});
</script>
