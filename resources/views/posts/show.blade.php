<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-yellow-300">
                    <div>
                        <p class="text-gray-900"><strong>User:</strong> {{ $post->user->first_name }}
                            {{ $post->user->middle_name }} {{ $post->user->last_name }}</p>
                        <p class="text-gray-900"><strong>Title:</strong> {{ $post->post_title }}</p>
                        <p class="text-gray-900"><strong>Content:</strong> {{ $post->post_content }}</p>
                        <p class="text-gray-900"><strong>Type:</strong> {{ ucfirst($post->post_type) }}</p>
                        <p class="text-gray-900"><strong>Uploaded By:</strong> {{ $post->post_uploaded_by }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
