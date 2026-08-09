<x-app-layout>

    <x-slot name="header">
        <h2 class="text-3xl font-bold">
            Problem Details
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8 px-4">

        {{-- Success message --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error message --}}
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif


        {{-- Problem information card --}}
        <div class="bg-white shadow-lg rounded-xl p-8">

            {{-- Title --}}
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ $problem->title }}
                </h1>

                <p class="text-gray-500 mt-2">
                    {{ $problem->course }}
                    |
                    {{ $problem->chapter }}
                </p>
            </div>


            {{-- Description --}}
            <div class="mb-6">

                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                    Problem Description
                </h3>

                <div class="bg-gray-50 rounded-lg p-4 text-gray-700 whitespace-pre-line">
                    {{ $problem->description }}
                </div>

            </div>


            {{-- Reward and deadline --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

                <div class="bg-green-50 rounded-lg p-4">

                    <p class="text-sm text-gray-500">
                        Reward
                    </p>

                    <p class="text-2xl font-bold text-green-700">
                        ৳ {{ number_format($problem->reward, 2) }}
                    </p>

                </div>


                <div class="bg-blue-50 rounded-lg p-4">

                    <p class="text-sm text-gray-500">
                        Deadline
                    </p>

                    <p class="text-2xl font-bold text-blue-700">
                        {{ $problem->deadline }}
                    </p>

                </div>

            </div>


            {{-- Additional information --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

                <div>

                    <p class="text-sm text-gray-500">
                        Department
                    </p>

                    <p class="font-semibold">
                        {{ $problem->department }}
                    </p>

                </div>


                <div>

                    <p class="text-sm text-gray-500">
                        Difficulty
                    </p>

                    <p class="font-semibold">
                        {{ $problem->difficulty }}
                    </p>

                </div>


                <div>

                    <p class="text-sm text-gray-500">
                        Status
                    </p>

                    <p class="font-semibold">
                        {{ $problem->status }}
                    </p>

                </div>

            </div>


            {{-- Attachment --}}
            <div class="border-t pt-6 mb-8">

                <h3 class="text-lg font-semibold text-gray-800 mb-3">
                    Problem Attachment
                </h3>

                @if($problem->attachment)

                    <a
                        href="{{ asset('storage/' . $problem->attachment) }}"
                        target="_blank"
                        class="inline-flex items-center bg-gray-800 text-white px-5 py-3 rounded-lg hover:bg-gray-900">

                        View / Open Attachment

                    </a>

                    <p class="text-sm text-gray-500 mt-2">
                        You can open the uploaded PDF, image, or document.
                    </p>

                @else

                    <p class="text-gray-500">
                        No attachment was uploaded with this problem.
                    </p>

                @endif

            </div>


            {{-- Start Working --}}
            <div class="border-t pt-6">

                @if($problem->status === 'Open')

    <form
        method="POST"
        action="{{ route('tutor.problems.start', $problem->id) }}">

        @csrf

        <button
            type="submit"
            class="w-full bg-blue-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-blue-700">

            Start Working

        </button>

    </form>

@elseif($problem->status === 'In Progress')

    <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg text-center font-semibold">

        This problem is currently being worked on.

    </div>

@elseif($problem->status === 'Solved')

    <div class="bg-green-100 text-green-800 p-4 rounded-lg text-center font-semibold">

        This problem has already been solved.

    </div>

@elseif($problem->status === 'Expired')

    <div class="bg-red-100 text-red-800 p-4 rounded-lg text-center font-semibold">

        This problem has expired.

    </div>

@endif

            </div>

        </div>

    </div>

</x-app-layout>
