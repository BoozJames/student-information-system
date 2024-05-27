<!-- resources/views/submissions/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        @if (Auth::user()->user_type === 'teacher' || Auth::user()->user_type === 'admin')
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Submissions') }}
            </h2>
        @else
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Submissions') }}
            </h2>
        @endif
    </x-slot>

    <!-- Include the toast component -->
    <x-toast />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto p-6 bg-white border-b border-yellow-300">
                    <nav class="flex flex-wrap mb-4">
                        <div class="ml-auto">
                            @if (Auth::user()->user_type === 'student')
                                <a href="{{ route('submissions.create') }}" class="mb-2 py-2 px-4 bg-[#40930B] rounded">
                                    Create Submission
                                </a>
                            @endif
                        </div>
                    </nav>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Subject
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    File
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Submitted At
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Score
                                </th>
                                @if (Auth::user()->user_type !== 'teacher')
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Teacher
                                    </th>
                                @endif
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($submissions as $submission)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $submission->subject->subject_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <a href="{{ Storage::url($submission->file_path) }}"
                                            class="text-blue-500 hover:text-blue-700" target="_blank">
                                            Download
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($submission->submitted_at)->format('F j, Y g:ia') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $submission->grade ?? 'N/A' }}
                                    </td>
                                    @if (Auth::user()->user_type !== 'teacher')
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $submission->subject->teacher->name ?? 'N/A' }}
                                        </td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if (Auth::user()->user_type !== 'student')
                                            <a href="{{ route('submissions.show', $submission->id) }}"
                                                class="text-blue-500 hover:text-blue-700 mr-2">Show</a>
                                            <a href="{{ route('submissions.edit', $submission->id) }}"
                                                class="text-green-500 hover:text-green-700 mr-2">Edit</a>
                                        @endif
                                        <form action="{{ route('submissions.destroy', $submission->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700">Unsubmit</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $submissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
