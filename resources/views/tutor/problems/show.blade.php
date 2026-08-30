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
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>

                </svg>

            </div>

            <div>

                <h2 class="text-2xl font-bold text-slate-900">
                    Problem Details
                </h2>

                <p class="text-sm text-slate-500">
                    View the details and solutions for this academic problem
                </p>

            </div>

        </div>

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
        <div class="bg-slate-200 shadow-lg rounded-xl p-8">

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

                    <td class="p-4 text-center">

                        <div class="flex justify-center items-center gap-2">

                            <a
    href="{{ asset('storage/' . $problem->attachment) }}"
    target="_blank"
    class="inline-flex items-center gap-2
           bg-blue-600 hover:bg-blue-700
           text-white px-4 py-2
           rounded-lg
           text-sm font-semibold
           shadow-sm hover:shadow-md
           transition-all duration-200">

    <!-- Eye Icon -->
    <svg xmlns="http://www.w3.org/2000/svg"
         class="w-4 h-4"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor"
         stroke-width="2">

        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M2.458 12C3.732 7.943 7.523 5 12 5
                 c4.477 0 8.268 2.943 9.542 7
                 -1.274 4.057-5.065 7-9.542 7
                 -4.477 0-8.268-2.943-9.542-7z"/>

        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>

    </svg>

    <span>View Attachment</span>

</a>
                            @if(auth()->user()->bookmarkedProblems()->where('problem_id', $problem->id)->exists())

                                <form
                                    method="POST"
                                    action="{{ route('tutor.bookmarks.destroy', $problem->id) }}">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-lg text-sm font-medium transition">

                                        ★ Bookmarked

                                    </button>

                                </form>

                            @else

                                <form
                                    method="POST"
                                    action="{{ route('tutor.bookmarks.store', $problem->id) }}">

                                    @csrf

                                    <button
                                        type="submit"
                                        class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1.5 rounded-lg text-sm font-medium transition">

                                        ☆ Bookmark

                                    </button>

                                </form>

                            @endif

                        </div>

                    </td>

                    <p class="text-sm text-gray-500 mt-2">
                        You can open the uploaded PDF, image, or document.
                    </p>

                @else

                    <p class="text-gray-500">
                        No attachment was uploaded with this problem.
                    </p>

                @endif

            </div>

            {{-- Report Problem --}}
            <div class="border-t pt-6 mb-6">

                <a
                    href="{{ route('reports.problem.create', $problem->id) }}"
                    class="inline-flex items-center gap-2
                        bg-red-600 hover:bg-red-700
                        text-white px-4 py-2
                        rounded-lg
                        text-sm font-semibold
                        transition">

                    Report Problem

                </a>

            </div>


 {{-- Start Working / Submit Solution --}}
<div class="border-t pt-6">

    @php
        $mySolution = \App\Models\Solution::where('problem_id', $problem->id)
            ->where('student_tutor_id', auth()->id())
            ->first();
    @endphp


    @if($problem->status === 'Solved')

        <div class="bg-green-100 text-green-800 p-4 rounded-lg
                    text-center font-semibold">

            ✓ This problem has already been solved.

        </div>


    @elseif($problem->status === 'Expired')

        <div class="bg-red-100 text-red-800 p-4 rounded-lg
                    text-center font-semibold">

            This problem has expired.

        </div>


    @elseif($mySolution && $mySolution->status === 'submitted')

        <div class="bg-blue-50 border border-blue-200
                    text-blue-800 p-4 rounded-lg text-center">

            <p class="font-semibold">
                ✓ You have already submitted a solution.
            </p>

            <p class="text-sm mt-1">
                The student will review your solution.
            </p>

        </div>


    @elseif($mySolution && $mySolution->status === 'draft')

        <form
            method="POST"
            action="{{ route('tutor.solutions.submit', $mySolution->id) }}">

            @csrf

            <a
                href="{{ route('tutor.solutions.create', $mySolution->id) }}"
                class="block w-full bg-blue-600 text-white
                       py-4 rounded-xl font-bold text-lg
                       text-center hover:bg-blue-700 transition">

                Continue Your Solution

            </a>

        </form>


    @else

        <form
            method="POST"
            action="{{ route('tutor.problems.start', $problem->id) }}">

            @csrf

            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-4
                       rounded-xl font-bold text-lg
                       hover:bg-blue-700 transition">

                @if($problem->status === 'Open')
                    Start Working
                @else
                    Submit Your Own Solution
                @endif

            </button>

        </form>

        @if($problem->status === 'In Progress')

            <p class="text-sm text-gray-500 text-center mt-3">

                Other Student Tutors are also working on this problem.
                You can submit your own solution.

            </p>

        @endif

    @endif

</div>
        </div>

    </div>

</x-app-layout>
