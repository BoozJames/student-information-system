<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Resource') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-yellow-300">
                    <form method="POST" action="{{ route('resources.update', $resource->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Resource Name -->
                        <div class="mt-4">
                            <label for="resource_name"
                                class="block font-medium text-sm text-gray-900">{{ __('Resource Name') }}</label>
                            <input id="resource_name" class="block mt-1 w-full rounded text-gray-900" type="text"
                                name="resource_name" value="{{ $resource->resource_name }}" required autofocus />
                        </div>

                        <!-- Resource Type -->
                        <div class="mt-4">
                            <label for="resource_type"
                                class="block font-medium text-sm text-gray-900">{{ __('Resource Type') }}</label>
                            <input id="resource_type" class="block mt-1 w-full rounded text-gray-900" type="text"
                                name="resource_type" value="{{ $resource->resource_type }}" required />
                        </div>

                        <!-- Uploaded By -->
                        <div class="mt-4">
                            <label for="resource_uploaded_by"
                                class="block font-medium text-sm text-gray-900">{{ __('Uploaded By') }}</label>
                            <select id="resource_uploaded_by" name="resource_uploaded_by"
                                class="block mt-1 w-full rounded text-gray-900" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $user->id == $resource->resource_uploaded_by ? 'selected' : '' }}>
                                        {{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Resource File -->
                        <div class="mt-4">
                            <label for="resource_file"
                                class="block font-medium text-sm text-gray-900">{{ __('File') }}</label>
                            <input id="resource_file" class="block mt-1 w-full rounded text-gray-900" type="file"
                                name="resource_file" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="ml-4 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#40930B] hover:bg-[#355521] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
