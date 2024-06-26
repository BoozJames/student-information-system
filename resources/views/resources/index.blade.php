<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resources') }}
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
                        <div class="ml-auto">
                            @if (Auth::user()->user_type !== 'student')
                                <a href="{{ route('resources.create') }}" class="mb-2 py-2 px-4 bg-[#40930B] rounded">
                                    Create Resource
                                </a>
                            @endif
                        </div>
                    </nav>
                    <div class="min-w-full align-middle">
                        <div class="my-4 bg-white">
                            <div class="flex flex-wrap items-center justify-between">
                                <!-- Search form -->
                                <form method="GET" action="{{ route('resources.index') }}"
                                    class="flex flex-wrap items-center">
                                    <input type="text" name="search" placeholder="Search..."
                                        class="mr-2 px-4 py-2 border rounded focus:border-yellow-300 text-gray-900">
                                    <button type="submit" class="bg-[#40930B] px-4 py-2 rounded">Search</button>
                                </form>
                                <!-- Dropdown filter -->
                                <select id="filter" onchange="filter(this.value)"
                                    class="mb-2 py-2 pr-7 bg-white border rounded text-gray-900 focus:border-yellow-300">
                                    <option value="" selected>Filter</option>
                                    @foreach ($resourceTypes as $type)
                                        <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4">
                            @foreach ($resources as $resource)
                                <div
                                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-2 border-yellow-300">
                                    <div class="p-6">
                                        <a href="{{ route('resources.show', $resource->id) }}">
                                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                                {{ $resource->resource_name }}
                                            </h5>
                                        </a>
                                        <p class="mb-3 font-normal text-gray-700">{{ $resource->resource_type }}</p>
                                        @if ($resource->user)
                                            <p class="mb-3 font-normal text-gray-700">
                                                Uploaded By: {{ $resource->user->first_name ?? '' }}
                                                {{ $resource->user->middle_name ? $resource->user->middle_name . ' ' : '' }}
                                                {{ $resource->user->last_name ?? '' }}
                                            </p>
                                        @endif
                                        <a href="{{ Storage::url('resources/' . $resource->resource_filename) }}"
                                            class="text-blue-600 hover:text-blue-800"
                                            download="{{ $resource->resource_filename }}">Download</a>
                                        <div class="mt-4 flex justify-end">
                                            @if (Auth::user()->user_type !== 'student')
                                                <a href="{{ route('resources.show', $resource->id) }}"
                                                    class="text-blue-500 hover:text-blue-700 mr-2">Show</a>
                                                <a href="{{ route('resources.edit', $resource->id) }}"
                                                    class="text-green-500 hover:text-green-700 mr-2">Edit</a>
                                                <form action="{{ route('resources.destroy', $resource->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-500 hover:text-red-700">Delete</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="mt-2">
                        {{ $resources->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function resetFilters() {
        window.location.href = "{{ route('resources.index') }}";
    }

    function filter(type) {
        if (type !== '') {
            window.location.href = "{{ route('resources.index') }}?type=" + type;
        } else {
            resetFilters();
        }
    }
</script>
