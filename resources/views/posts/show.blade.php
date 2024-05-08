<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post Details') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $post->post_title }}</h1>
                    <p class="text-gray-700 mb-4">{{ $post->post_content }}</p>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600">Type: {{ ucfirst($post->post_type) }}</p>
                            <p class="text-gray-600">Uploaded By: {{ $post->post_uploaded_by }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
