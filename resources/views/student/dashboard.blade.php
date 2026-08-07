<x-app-layout>

    <x-slot name="header">
        <h2 class="text-3xl font-bold">
            Student Dashboard
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8">

        <h1 class="text-2xl font-semibold mb-6">
            Welcome, {{ auth()->user()->name }} 👋
        </h1>

        <div class="grid grid-cols-4 gap-6">

            <div class="bg-blue-500 text-white rounded-xl p-6 shadow">
                <h3>Total Problems</h3>
                <p class="text-4xl font-bold mt-3">
                    {{ $totalProblems }}
                </p>
            </div>

            <div class="bg-green-500 text-white rounded-xl p-6 shadow">
                <h3>Open</h3>
                <p class="text-4xl font-bold mt-3">
                    {{ $openProblems }}
                </p>
            </div>

            <div class="bg-yellow-500 text-white rounded-xl p-6 shadow">
                <h3>In Progress</h3>
                <p class="text-4xl font-bold mt-3">
                    {{ $inProgressProblems }}
                </p>
            </div>

            <div class="bg-purple-500 text-white rounded-xl p-6 shadow">
                <h3>Solved</h3>
                <p class="text-4xl font-bold mt-3">
                    {{ $solvedProblems }}
                </p>
            </div>

        </div>
        <br><br>
        <div class="mb-6">
        <a href="{{ route('problems.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
            + Post New Problem
        </a>
        </div>
        <div class="mt-8 bg-white shadow rounded-xl overflow-hidden">

    <div class="p-5 border-b">

        <h2 class="text-xl font-bold">

            Recent Problems

        </h2>

    </div>

    <table class="w-full">

        <thead class="bg-gray-100">

        <tr>

            <th class="p-4 text-left">Title</th>
            <th class="p-4 text-left">Course</th>
            <th class="p-4 text-left">Reward</th>
            <th class="p-4 text-left">Status</th>

        </tr>

        </thead>

        <tbody>

        @forelse($recentProblems as $problem)

            <tr class="border-t">

                <td class="p-4">{{ $problem->title }}</td>

                <td class="p-4">{{ $problem->course }}</td>

                <td class="p-4">{{ $problem->reward }}</td>

                <td class="p-4">

                    {{ $problem->status }}

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="4" class="text-center p-6">

                    You haven't posted any problems yet.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>
<div class="mt-5 text-right">

    <a href="{{ route('problems.index') }}"
       class="text-blue-600 hover:underline font-semibold">

        View All Problems →

    </a>

</div>



    </div>


</x-app-layout>
