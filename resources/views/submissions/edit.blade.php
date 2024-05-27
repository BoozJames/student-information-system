<!-- resources/views/submissions/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Submission') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('submissions.update', $submission->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="grade"
                                class="block font-medium text-sm text-gray-700">{{ __('Grade') }}</label>
                            <input id="grade" type="number" name="grade"
                                value="{{ old('grade', $submission->grade) }}" min="0" max="100"
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="mt-4">
                            <label for="locked_at"
                                class="block font-medium text-sm text-gray-700">{{ __('Lock Date') }}</label>
                            <input id="locked_at" type="date" name="locked_at"
                                value="{{ old('locked_at', $submission->locked_at) }}"
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="mt-4">
                            <button type="submit"
                                class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
