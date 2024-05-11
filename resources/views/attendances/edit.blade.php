<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Attendance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-yellow-300">
                    <form method="POST" action="{{ route('attendances.update', $attendance->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Schedule -->
                        <div class="mt-4">
                            <label for="schedule_id"
                                class="block font-medium text-sm text-gray-900">{{ __('Schedule') }}</label>
                            <select id="schedule_id" name="schedule_id" class="block mt-1 w-full rounded text-gray-900">
                                <option value="">Select Schedule</option>
                                @foreach ($schedules as $schedule)
                                    <option value="{{ $schedule->id }}"
                                        @if ($attendance->schedule_id == $schedule->id) selected @endif>
                                        {{ $schedule->subject->subject_name }} - {{ $schedule->day_of_week }},
                                        {{ $schedule->start_time }} - {{ $schedule->end_time }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date -->
                        <div class="mt-4">
                            <label for="date"
                                class="block font-medium text-sm text-gray-900">{{ __('Date') }}</label>
                            <input id="date" class="block mt-1 w-full rounded text-gray-900" type="date"
                                name="date" value="{{ $attendance->date }}" required />
                        </div>

                        <!-- Attended -->
                        <div class="mt-4">
                            <label for="attended"
                                class="block font-medium text-sm text-gray-900">{{ __('Attended') }}</label>
                            <select id="attended" name="attended" class="block mt-1 w-full rounded text-gray-900">
                                <option value="1" @if ($attendance->attended == 1) selected @endif>Yes</option>
                                <option value="0" @if ($attendance->attended == 0) selected @endif>No</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="ml-4 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#40930B] hover:bg-[#355521] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                {{ __('Update Attendance') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
