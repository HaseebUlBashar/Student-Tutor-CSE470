<x-app-layout>

    <x-slot name="header">
        <h2 class="text-3xl font-bold">
            Student Tutor Dashboard
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8">

        <h1 class="text-2xl font-semibold mb-6">
            Welcome, {{ auth()->user()->name }} 👋
        </h1>

        <div class="bg-white shadow rounded-xl p-6">

            <h2 class="text-xl font-bold">
                Browse Academic Problems
            </h2>

            <p class="mt-2 text-gray-600">
                Find academic problems posted by students and search, filter,
                and sort them.
            </p>

            <div class="mt-5">
                <a href="{{ route('tutor.problems') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                    Browse Problems →
                </a>
            </div>

        </div>

    </div>

</x-app-layout>