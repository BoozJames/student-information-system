<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-yellow-300">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mt-4">
                            <label for="name"
                                class="block font-medium text-sm text-gray-900">{{ __('Name') }}</label>
                            <input id="name" class="block mt-1 w-full rounded text-gray-900" type="text"
                                name="name" required autofocus />
                        </div>

                        <!-- First Name -->
                        <div class="mt-4">
                            <label for="first_name"
                                class="block font-medium text-sm text-gray-900">{{ __('First Name') }}</label>
                            <input id="first_name" class="block mt-1 w-full rounded text-gray-900" type="text"
                                name="first_name" required />
                        </div>

                        <!-- Middle Name -->
                        <div class="mt-4">
                            <label for="middle_name"
                                class="block font-medium text-sm text-gray-900">{{ __('Middle Name') }}</label>
                            <input id="middle_name" class="block mt-1 w-full rounded text-gray-900" type="text"
                                name="middle_name" />
                        </div>

                        <!-- Last Name -->
                        <div class="mt-4">
                            <label for="last_name"
                                class="block font-medium text-sm text-gray-900">{{ __('Last Name') }}</label>
                            <input id="last_name" class="block mt-1 w-full rounded text-gray-900" type="text"
                                name="last_name" required />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <label for="email"
                                class="block font-medium text-sm text-gray-900">{{ __('Email') }}</label>
                            <input id="email" class="block mt-1 w-full rounded text-gray-900" type="email"
                                name="email" required />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <label for="password"
                                class="block font-medium text-sm text-gray-900">{{ __('Password') }}</label>
                            <input id="password" class="block mt-1 w-full rounded text-gray-900" type="password"
                                name="password" required />
                        </div>

                        <!-- User Type -->
                        <div class="mt-4">
                            <label for="user_type"
                                class="block font-medium text-sm text-gray-900">{{ __('User Type') }}</label>
                            <select id="user_type" name="user_type" class="block mt-1 w-full rounded text-gray-900"
                                required autofocus>
                                @if (Auth::user()->user_type === 'admin')
                                    <option value="admin">Admin</option>
                                    <option value="teacher">Teacher</option>
                                    <option value="student">Student</option>
                                @endif
                                @if (Auth::user()->user_type === 'teacher')
                                    <option value="teacher">Teacher</option>
                                    <option value="student">Student</option>
                                @endif
                            </select>
                        </div>

                        <!-- Section -->
                        <div class="mt-4">
                            <label for="section"
                                class="block font-medium text-sm text-gray-900">{{ __('Section') }}</label>
                            <input id="section" class="block mt-1 w-full rounded text-gray-900" type="text"
                                name="section"/>
                        </div>

                        <!-- Year Level -->
                        <div class="mt-4">
                            <label for="year_level"
                                class="block font-medium text-sm text-gray-900">{{ __('Year Level') }}</label>
                            <input id="year_level" class="block mt-1 w-full rounded text-gray-900" type="text"
                                name="year_level"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="ml-4 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#40930B] hover:bg-[#355521] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">{{ __('Create') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
