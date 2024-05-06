<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-yellow-300">
                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf

                        <!-- Post Title -->
                        <div class="mt-4">
                            <label for="post_title"
                                class="block font-medium text-sm text-gray-900">{{ __('Post Title') }}</label>
                            <input id="post_title" class="block mt-1 w-full rounded text-gray-900" type="text"
                                name="post_title" :value="old('post_title')" required />
                        </div>

                        <!-- Post Content -->
                        <div class="mt-4">
                            <label for="post_content"
                                class="block font-medium text-sm text-gray-900">{{ __('Post Content') }}</label>
                            <textarea id="post_content" class="block mt-1 w-full rounded text-gray-900" name="post_content" rows="5" required>{{ old('post_content') }}</textarea>
                        </div>

                        <!-- Post Type -->
                        <div class="mt-4">
                            <label for="post_type"
                                class="block font-medium text-sm text-gray-900">{{ __('Post Type') }}</label>
                            <select id="post_type" name="post_type" class="block mt-1 w-full rounded text-gray-900">
                                <option value="">Select Post Type</option>
                                <option value="news">News</option>
                                <option value="events">Events</option>
                            </select>
                        </div>

                        <!-- Uploaded By -->
                        <div class="mt-4">
                            <label for="user_id"
                                class="block font-medium text-sm text-gray-900">{{ __('Uploaded By') }}</label>
                            <select id="user_id" name="user_id" class="block mt-1 w-full rounded text-gray-900">
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="ml-4 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#40930B] hover:bg-[#355521] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                {{ __('Create Post') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
