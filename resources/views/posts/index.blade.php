<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <!-- Include the toast component -->
    <x-toast />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto p-6 bg-white border-b border-yellow-300">
                    <nav class="flex flex-wrap mb-4">
                        <a href="#" onclick="resetFilters()" class="mr-4 mb-2 py-2 px-4 bg-[#40930B] rounded">
                            Reset Filters
                        </a>
                        @if (Auth::user()->user_type !== 'student')
                            <div class="ml-auto">
                                <a href="{{ route('posts.create') }}" class="mb-2 py-2 px-4 bg-[#40930B] rounded">
                                    Create Post
                                </a>
                            </div>
                        @endif
                    </nav>
                    <div class="min-w-full align-middle">
                        <div class="my-2 bg-white">
                            <div class="flex flex-wrap items-center justify-between">
                                <!-- Search form -->
                                <form method="GET" action="{{ route('posts.index') }}"
                                    class="flex flex-wrap items-center">
                                    <input type="text" name="search" placeholder="Search..."
                                        class="mr-2 px-4 py-2 border rounded focus:border-yellow-300 text-gray-900">
                                    <button type="submit"
                                        class="bg-[#40930B] px-4 py-2 rounded text-white">Search</button>
                                </form>
                                <!-- Dropdown filter -->
                                <select id="filter" onchange="filter(this.value)"
                                    class="mb-2 py-2 pr-7 bg-white border rounded text-gray-900 focus:border-yellow-300">
                                    <option value="">Filter</option>
                                    <option value="events">Events</option>
                                    <option value="announcement">Announcements</option>
                                </select>
                            </div>
                        </div>

                        <!-- Replace table with cards -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($posts as $post)
                                <div
                                    class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:border-yellow-300">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-dark">
                                        {{ $post->post_title }}</h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        {{ Illuminate\Support\Str::limit($post->post_content, 20) }}</p>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Type:
                                        {{ $post->post_type }}</p>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Uploaded By:
                                        {{ $post->post_uploaded_by }}</p>
                                    <!-- Inside the foreach loop where you display each post -->
                                    <div class="flex justify-end mt-4">
                                        <a href="{{ route('posts.show', $post->id) }}"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-[#40930B] rounded-lg hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-yellow-300">Show</a>

                                        <!-- Add condition to show edit and delete buttons -->
                                        @if (Auth::user()->user_type !== 'student')
                                            <a href="{{ route('posts.edit', $post->id) }}"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-[#40930B] rounded-lg hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 ml-2">Edit</a>

                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-500 rounded-lg hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 ml-2">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-2">
                        {{ $posts->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function resetFilters() {
        window.location.href = "{{ route('posts.index') }}";
    }

    function filter(type) {
        if (type !== '') {
            window.location.href = "{{ route('posts.index') }}?type=" + type;
        } else {
            resetFilters();
        }
    }
</script>
