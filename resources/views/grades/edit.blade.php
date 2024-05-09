<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Grade') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-yellow-300">
                    <form method="POST" action="{{ route('grades.update', $grade->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- User -->
                        <div class="mt-4">
                            <label for="user_id"
                                class="block font-medium text-sm text-gray-900">{{ __('User') }}</label>
                            <select id="user_id" name="user_id" class="block mt-1 w-full rounded text-gray-900">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        @if ($grade->user_id == $user->id) selected @endif>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Subject -->
                        <div class="mt-4">
                            <label for="subject_id"
                                class="block font-medium text-sm text-gray-900">{{ __('Subject') }}</label>
                            <select id="subject_id" name="subject_id" class="block mt-1 w-full rounded text-gray-900">
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        @if ($grade->subject_id == $subject->id) selected @endif>{{ $subject->subject_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Value -->
                        <div class="mt-4">
                            <label for="value"
                                class="block font-medium text-sm text-gray-900">{{ __('Value') }}</label>
                            <input id="value" class="block mt-1 w-full rounded text-gray-900" type="number"
                                name="value" value="{{ $grade->value }}" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="ml-4 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#40930B] hover:bg-[#355521] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                {{ __('Update Grade') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
