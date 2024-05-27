<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Submission Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <h3 class="text-lg font-semibold">Subject: {{ $submission->subject->subject_name }}</h3>
                        <p><strong>Submitted At:</strong> {{ $submission->submitted_at }}</p>
                        <p><strong>Grade:</strong> {{ $submission->grade ?? 'N/A' }}</p>
                        <p>
                            <strong>File:</strong>
                            <a href="{{ Storage::url($submission->file_path) }}" class="text-blue-500 hover:text-blue-700"
                                target="_blank">Download</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
