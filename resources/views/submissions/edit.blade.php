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
                            <x-label for="grade" :value="__('Grade')" />
                            <x-input id="grade" type="number" name="grade" value="{{ $submission->grade }}"
                                min="0" max="100" />
                        </div>

                        <div class="mt-4">
                            <x-label for="locked_at" :value="__('Lock Date')" />
                            <x-input id="locked_at" type="date" name="locked_at"
                                value="{{ $submission->locked_at ? $submission->locked_at->format('Y-m-d') : '' }}" />
                        </div>

                        <div class="mt-4">
                            <x-button>{{ __('Update') }}</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
