<!-- resources/views/submissions/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Submission') }}
        </h2>
    </x-slot>

    <!-- Include the toast component -->
    <x-toast />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-yellow-300">
                    <form action="{{ route('submissions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Subject -->
                        <div class="mt-4">
                            <label for="subject_id"
                                class="block font-medium text-sm text-gray-900">{{ __('Subject') }}</label>
                            <select id="subject_id" name="subject_id" class="block mt-1 w-full rounded text-gray-900">
                                <option value="">Select Subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->subject_name }} ({{ $subject->teacher->name }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- File Upload -->
                        <div class="mt-4">
                            <label for="file"
                                class="block font-medium text-sm text-gray-900">{{ __('File') }}</label>
                            <input id="file" class="block mt-1 w-full rounded text-gray-900" type="file"
                                name="file" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="ml-4 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#40930B] hover:bg-[#355521] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                {{ __('Create Submission') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
