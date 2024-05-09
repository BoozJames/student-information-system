<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resource Details') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $resource->resource_name }}</h1>
                    <p class="text-gray-700 mb-4">{{ $resource->resource_type }}</p>
                    <p class="text-gray-700 mb-4">{{ $resource->resource_filename }}</p>
                    <a href="{{ Storage::url('resources/' . $resource->resource_filename) }}"
                        class="text-blue-600 hover:text-blue-800"
                        download="{{ $resource->resource_filename }}">Download</a>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600">Uploaded By: {{ $resource->resource_uploaded_by }}</p>
                            <p class="text-gray-600">{{ $resource->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
