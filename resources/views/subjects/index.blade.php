<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subjects') }}
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
                            <a href="{{ route('subjects.create') }}" class="mb-2 py-2 px-4 bg-[#40930B] rounded">
                                Create Subject
                            </a>
                        </div>
                    </nav>
                    <div class="min-w-full align-middle">
                        <div class="my-2 bg-white">
                            <div class="flex flex-wrap items-center justify-between">
                                <!-- Search form -->
                                <form method="GET" action="{{ route('subjects.index') }}"
                                    class="flex flex-wrap items-center">
                                    <input type="text" name="search" placeholder="Search..."
                                        class="mr-2 px-4 py-2 border rounded focus:border-yellow-300 text-gray-900">
                                    <button type="submit" class="bg-[#40930B] px-4 py-2 rounded">Search</button>
                                </form>
                                <!-- Dropdown filter (if needed) -->
                            </div>
                        </div>

                        <table class="min-w-full divide-y divide-gray-200 border">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span
                                            class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Subject
                                            Name</span>
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span
                                            class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Subject
                                            Code</span>
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span
                                            class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Teacher</span>
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left">
                                        <span
                                            class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @foreach ($subjects as $subject)
                                    <tr class="bg-white">
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            {{ $subject->subject_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            {{ $subject->subject_code }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            {{ $subject->teacher->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                            <a href="{{ route('subjects.show', $subject->id) }}"
                                                class="text-blue-500 hover:text-blue-700 mr-2">Show</a>
                                            <a href="{{ route('subjects.edit', $subject->id) }}"
                                                class="text-green-500 hover:text-green-700 mr-2">Edit</a>
                                            <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-500 hover:text-red-700">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-2">
                        {{ $subjects->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function resetFilters() {
        window.location.href = "{{ route('subjects.index') }}";
    }
</script>
