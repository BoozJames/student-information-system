<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-yellow-300">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mt-4">
                            <label for="name"
                                class="block font-medium text-sm text-gray-900">{{ __('Name') }}</label>
                            <input id="name" class="block mt-1 w-full rounded text-gray-900" type="text"
                                name="name" value="{{ $user->name }}" required autofocus />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <label for="email"
                                class="block font-medium text-sm text-gray-900">{{ __('Email') }}</label>
                            <input id="email" class="block mt-1 w-full rounded text-gray-900" type="email"
                                name="email" value="{{ $user->email }}" required />
                        </div>

                        <!-- User Type -->
                        <div class="mt-4">
                            <label for="user_type"
                                class="block font-medium text-sm text-gray-900">{{ __('User Type') }}</label>
                            <select id="user_type" name="user_type" class="block mt-1 w-full rounded text-gray-900"
                                required autofocus>
                                @if (Auth::user()->user_type === 'admin')
                                    <option value="admin"
                                        {{ old('user_type', $user->user_type) === 'admin' ? 'selected' : '' }}>Admin
                                    </option>
                                    <option value="teacher"
                                        {{ old('user_type', $user->user_type) === 'teacher' ? 'selected' : '' }}>Teacher
                                    </option>
                                    <option value="student"
                                        {{ old('user_type', $user->user_type) === 'student' ? 'selected' : '' }}>Student
                                    </option>
                                @endif
                                @if (Auth::user()->user_type === 'teacher')
                                    <option value="teacher"
                                        {{ old('user_type', $user->user_type) === 'teacher' ? 'selected' : '' }}>
                                        Teacher</option>
                                    <option value="student"
                                        {{ old('user_type', $user->user_type) === 'student' ? 'selected' : '' }}>
                                        Student</option>
                                @endif
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button
                                class="ml-4 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#40930B] hover:bg-[#355521] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
