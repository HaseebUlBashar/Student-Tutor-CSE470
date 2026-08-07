<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold">
                My Academic Problems
            </h2>

            <a href="{{ route('problems.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                + Post New Problem
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8">

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-5">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-xl overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4 text-left">Title</th>
                        <th class="p-4 text-left">Course</th>
                        <th class="p-4 text-left">Reward</th>
                        <th class="p-4 text-left">Deadline</th>
                        <th class="p-4 text-left">Status</th>
                        <th class="p-4 text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($problems as $problem)

                    <tr class="border-t">
                        <td class="p-4">{{ $problem->title }}</td>
                        <td class="p-4">{{ $problem->course }}</td>
                        <td class="p-4">৳ {{ number_format($problem->reward,2) }}</td>
                        <td class="p-4">{{ $problem->deadline }}</td>

                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">
                                {{ $problem->status }}
                            </span>
                        </td>

                        <td class="p-4 text-center">
                            <a href="{{ route('problems.edit', $problem->id) }}"
                               class="text-blue-600 hover:underline">
                                Edit
                            </a>

                            |

                            <form action="{{ route('problems.destroy', $problem->id) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Delete this problem?')"
                                        class="text-red-600 hover:underline">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center p-8">
                            No problems posted yet.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>
