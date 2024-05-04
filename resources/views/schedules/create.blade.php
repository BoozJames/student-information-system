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
                    <form method="POST" action="{{ route('subjects.store') }}">
                        @csrf

                        <!-- Subject Name -->
                        <div class="mt-4">
                            <label for="subject_name"
                                class="block font-medium text-sm text-gray-900">{{ __('Subject Name') }}</label>
                            <input id="subject_name" class="block mt-1 w-full rounded text-gray-900" type="text" name="subject_name"
                                :value="old('subject_name')" required autofocus />
                        </div>

                        <!-- Subject Code -->
                        <div class="mt-4">
                            <label for="subject_code"
                                class="block font-medium text-sm text-gray-900">{{ __('Subject Code') }}</label>
                            <input id="subject_code" class="block mt-1 w-full rounded text-gray-900" type="text" name="subject_code"
                                :value="old('subject_code')" required />
                        </div>

                        <!-- Teacher -->
                        <div class="mt-4">
                            <label for="teacher_id"
                                class="block font-medium text-sm text-gray-900">{{ __('Teacher') }}</label>
                            <select id="teacher_id" name="teacher_id" class="block mt-1 w-full rounded text-gray-900">
                                <option value="">Select Teacher</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="ml-4 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#40930B] hover:bg-[#355521] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                {{ __('Create Subject') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
