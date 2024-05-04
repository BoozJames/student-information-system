<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Subject') }}
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
                            <x-label for="subject_name" :value="__('Subject Name')" />

                            <x-input id="subject_name" class="block mt-1 w-full" type="text" name="subject_name"
                                :value="old('subject_name')" required autofocus />
                        </div>

                        <!-- Subject Code -->
                        <div class="mt-4">
                            <x-label for="subject_code" :value="__('Subject Code')" />

                            <x-input id="subject_code" class="block mt-1 w-full" type="text" name="subject_code"
                                :value="old('subject_code')" required />
                        </div>

                        <!-- Teacher -->
                        <div class="mt-4">
                            <x-label for="teacher_id" :value="__('Teacher')" />

                            <select id="teacher_id" name="teacher_id" class="block mt-1 w-full">
                                <option value="">Select Teacher</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Create Subject') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
