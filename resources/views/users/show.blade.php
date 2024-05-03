<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-yellow-300">
                    <div>
                        <p class="text-gray-900"><strong>Name:</strong> {{ $user->name }}</p>
                        <p class="text-gray-900"><strong>Email:</strong> {{ $user->email }}</p>
                        <p class="text-gray-900"><strong>User Type:</strong> {{ $user->user_type }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
