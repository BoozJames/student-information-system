<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="text-gray-900 mt-1 block w-full"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" name="first_name" type="text" class="text-gray-900 mt-1 block w-full"
                :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <div>
            <x-input-label for="middle_name" :value="__('Middle Name')" />
            <x-text-input id="middle_name" name="middle_name" type="text" class="text-gray-900 mt-1 block w-full"
                :value="old('middle_name', $user->middle_name)" autofocus autocomplete="middle_name" />
            <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
        </div>

        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" name="last_name" type="text" class="text-gray-900 mt-1 block w-full"
                :value="old('last_name', $user->last_name)" required autofocus autocomplete="last_name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>


        @switch($user->user_type)
            @case('admin')
                <x-input-label for="user_type" :value="__('User Type')" />
                <select id="user_type" name="user_type" class="text-gray-900 mt-1 block w-full rounded" required autofocus
                    autocomplete="user_type">
                    <option value="admin" {{ old('user_type', $user->user_type) === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="teacher" {{ old('user_type', $user->user_type) === 'teacher' ? 'selected' : '' }}>Teacher
                    </option>
                    <option value="student" {{ old('user_type', $user->user_type) === 'student' ? 'selected' : '' }}>Student
                    </option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('user_type')" />
            @break

            @case('teacher')
                <x-input-label for="user_type" :value="__('User Type')" />
                <select id="user_type" name="user_type" class="text-gray-900 mt-1 block w-full rounded" disabled required
                    autofocus autocomplete="user_type">
                    <option value="teacher" {{ old('user_type', $user->user_type) === 'teacher' ? 'selected' : '' }}>Teacher
                    </option>
                    <option value="student" {{ old('user_type', $user->user_type) === 'student' ? 'selected' : '' }}>Student
                    </option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('user_type')" />
            @break

            @default
                <!-- Handle other cases if needed -->
        @endswitch

        @if ($user->user_type === 'student')
            <div>
                <x-input-label for="section" :value="__('Section')" />
                <x-text-input id="section" name="section" type="text" class="text-gray-900 mt-1 block w-full"
                    :value="old('section', $user->section)" required autofocus autocomplete="section" />
                <x-input-error class="mt-2" :messages="$errors->get('section')" />
            </div>

            <div>
                <x-input-label for="year_level" :value="__('Year Level')" />
                <x-text-input id="year_level" name="year_level" type="text" class="text-gray-900 mt-1 block w-full"
                    :value="old('year_level', $user->year_level)" required autofocus autocomplete="year_level" />
                <x-input-error class="mt-2" :messages="$errors->get('year_level')" />
            </div>
        @endif

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="text-gray-900 mt-1 block w-full"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
