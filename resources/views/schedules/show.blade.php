<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Class Schedule Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-yellow-300">
                    <div>
                        <p class="text-gray-900"><strong>User:</strong> {{ $schedule->user->name }}</p>
                        <p class="text-gray-900"><strong>Subject:</strong> {{ $schedule->subject->subject_name }}</p>
                        <p class="text-gray-900"><strong>Day of Week:</strong> {{ $schedule->day_of_week }}</p>
                        <p class="text-gray-900"><strong>Start Time:</strong> {{ $schedule->start_time }}</p>
                        <p class="text-gray-900"><strong>End Time:</strong> {{ $schedule->end_time }}</p>
                        <p class="text-gray-900"><strong>Attendance:</strong>
                            {{ $schedule->attendance ? 'Present' : 'Absent' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
