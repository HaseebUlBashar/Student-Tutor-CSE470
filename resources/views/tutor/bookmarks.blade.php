<x-app-layout>

    <x-slot name="header">
        <h2 class="text-3xl font-bold">
            ⭐ Bookmarked Problems
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8">

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

            <div class="p-6 border-b">
                <h3 class="text-xl font-bold">
                    Your Saved Problems
                </h3>

                <p class="text-gray-600 mt-1">
                    Problems you saved for later.
                </p>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="p-4 text-left">
                                Title
                            </th>

                            <th class="p-4 text-left">
                                Department
                            </th>

                            <th class="p-4 text-left">
                                Course
                            </th>

                            <th class="p-4 text-left">
                                Difficulty
                            </th>

                            <th class="p-4 text-left">
                                Reward
                            </th>

                            <th class="p-4 text-left">
                                Deadline
                            </th>

                            <th class="p-4 text-center">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($problems as $problem)

                        <tr class="border-t hover:bg-gray-50">

                            <td class="p-4 font-medium">
                                {{ $problem->title }}
                            </td>

                            <td class="p-4">
                                {{ $problem->department }}
                            </td>

                            <td class="p-4">
                                {{ $problem->course }}
                            </td>

                            <td class="p-4">
                                {{ $problem->difficulty }}
                            </td>

                            <td class="p-4">
                                ৳ {{ number_format($problem->reward, 2) }}
                            </td>

                            <td class="p-4">
                                {{ $problem->deadline }}
                            </td>

                            <td class="p-4 text-center">

                                <div class="flex justify-center gap-2">

                                    <a
                                        href="{{ route('tutor.problems.show', $problem->id) }}"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg text-sm">

                                        View

                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('tutor.bookmarks.destroy', $problem->id) }}">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-sm">

                                            Remove

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center p-10 text-gray-500">

                                ⭐ You haven't bookmarked any problems yet.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>
