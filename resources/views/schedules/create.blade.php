<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Class Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-yellow-300">
                    <form method="POST" action="{{ route('schedules.store') }}">
                        @csrf

                        <!-- User -->
                        <div class="mt-4">
                            <label for="user_id"
                                class="block font-medium text-sm text-gray-900">{{ __('User') }}</label>
                            <select id="user_id" name="user_id" class="block mt-1 w-full rounded text-gray-900">
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Subject -->
                        <div class="mt-4">
                            <label for="subject_id"
                                class="block font-medium text-sm text-gray-900">{{ __('Subject') }}</label>
                            <select id="subject_id" name="subject_id" class="block mt-1 w-full rounded text-gray-900">
                                <option value="">Select Subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Day of Week -->
                        <div class="mt-4">
                            <label for="day_of_week"
                                class="block font-medium text-sm text-gray-900">{{ __('Day of Week') }}</label>
                            <select id="day_of_week" name="day_of_week" class="block mt-1 w-full rounded text-gray-900">
                                <option value="">Select Day of Week</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                            </select>
                        </div>

                        <!-- Start Time -->
                        <div class="mt-4">
                            <label for="start_time"
                                class="block font-medium text-sm text-gray-900">{{ __('Start Time') }}</label>
                            <input id="start_time" class="block mt-1 w-full rounded text-gray-900" type="time"
                                name="start_time" :value="old('start_time')" required />
                        </div>

                        <!-- End Time -->
                        <div class="mt-4">
                            <label for="end_time"
                                class="block font-medium text-sm text-gray-900">{{ __('End Time') }}</label>
                            <input id="end_time" class="block mt-1 w-full rounded text-gray-900" type="time"
                                name="end_time" :value="old('end_time')" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="ml-4 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#40930B] hover:bg-[#355521] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                {{ __('Create Class Schedule') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
