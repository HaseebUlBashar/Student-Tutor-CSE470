<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-xl bg-blue-600
                        flex items-center justify-center text-white">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-4-7 4V5z"/>

                </svg>

            </div>

            <div>

                <h2 class="text-2xl font-bold text-slate-900">
                    Bookmarked Problems
                </h2>

                <p class="text-sm text-slate-500">
                    View and manage your saved academic problems
                </p>

            </div>

        </div>

    </x-slot>

    <div class="max-w-7xl mx-auto py-8">

        <div class="bg-amber-50 shadow-xl rounded-2xl overflow-hidden">

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
