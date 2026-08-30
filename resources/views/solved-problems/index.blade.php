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
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332-.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332-.477-4.5 1.253"/>

                </svg>

            </div>

            <div>

                <h2 class="text-2xl font-bold text-slate-900">
                    Previously Solved Problems
                </h2>

                <p class="text-sm text-slate-500">
                    Search previously solved problems and learn from their accepted solutions
                </p>

            </div>

        </div>

    </x-slot>

    <div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

        {{-- Search --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">

            <form method="GET" action="{{ route('student.solved-problems') }}">

                <label for="search"
                       class="block text-sm font-semibold text-slate-700 mb-2">
                    Search Solved Problems
                </label>

                <div class="flex flex-col sm:flex-row gap-3">

                    <input
                        id="search"
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search by course, topic, chapter, or keyword..."
                        class="flex-1 rounded-xl border-slate-300
                               focus:border-blue-500 focus:ring-blue-500
                               px-4 py-3"
                    >

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2
                               bg-blue-600 hover:bg-blue-700
                               text-white font-semibold
                               px-6 py-3 rounded-xl
                               shadow-sm hover:shadow-md
                               transition">

                        🔍 Search

                    </button>

                </div>

                @if($search)
                    <div class="mt-3 flex items-center justify-between">

                        <p class="text-sm text-slate-500">
                            Showing results for:
                            <span class="font-semibold text-slate-700">
                                "{{ $search }}"
                            </span>
                        </p>

                        <a href="{{ route('student.solved-problems') }}"
                           class="text-sm font-semibold text-blue-600 hover:text-blue-700">
                            Clear
                        </a>

                    </div>
                @endif

            </form>

        </div>


        {{-- Results Header --}}
        <div class="flex items-center justify-between mb-5">

            <div>
                <h2 class="text-2xl font-bold text-slate-900">
                    Previously Solved Problems
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Browse questions that already have accepted solutions.
                </p>
            </div>

            <span class="px-3 py-1 rounded-full bg-blue-50
                         text-blue-700 font-semibold text-sm">

                {{ $problems->count() }} Results

            </span>

        </div>


        {{-- Results --}}
        @forelse($problems as $problem)

            @php
                $acceptedSolution = $problem->solutions->first();
            @endphp

            <div class="bg-emerald-100 rounded-2xl shadow-sm
                        border border-slate-200 p-6 mb-5">

                {{-- Problem Header --}}
                <div class="flex items-start justify-between gap-4">

                    <div class="min-w-0">

                        <p class="text-sm text-slate-500">
                            {{ $problem->department }}
                            ·
                            {{ $problem->course }}
                            @if($problem->chapter)
                                ·
                                {{ $problem->chapter }}
                            @endif
                        </p>

                        <h3 class="text-xl font-bold text-slate-900 mt-1">
                            {{ $problem->title }}
                        </h3>

                    </div>

                    <span class="flex-shrink-0
                                 px-3 py-1.5 rounded-full
                                 bg-green-50 text-green-700
                                 font-semibold text-sm">

                        ✓ Solved

                    </span>

                </div>


                {{-- Problem Description --}}
                <div class="mt-5 bg-slate-50 rounded-xl p-5">

                    <h4 class="font-semibold text-slate-800 mb-2">
                        Problem
                    </h4>

                    <p class="text-slate-700 whitespace-pre-line">
                        {{ $problem->description }}
                    </p>

                </div>


                {{-- Accepted Solution --}}
                @if($acceptedSolution)

                    <div class="mt-5 border border-green-200
                                bg-green-50/50 rounded-xl p-5">

                        <div class="flex items-center justify-between gap-3 mb-3">

                            <h4 class="font-semibold text-slate-800">
                                ✓ Accepted Solution
                            </h4>

                            @if($acceptedSolution->studentTutor)

                                <span class="text-sm text-slate-500">
                                    By {{ $acceptedSolution->studentTutor->name }}
                                </span>

                            @endif

                        </div>

                        <p class="text-slate-700 whitespace-pre-line">
                            {{ $acceptedSolution->description }}
                        </p>


                        @if($acceptedSolution->attachment)

                            <div class="mt-4">

                                <a
                                    href="{{ asset('storage/' . $acceptedSolution->attachment) }}"
                                    target="_blank"
                                    class="inline-flex items-center gap-2
                                           text-blue-600 hover:text-blue-700
                                           font-semibold">

                                    📎 View Solution Attachment

                                </a>

                            </div>

                        @endif

                    </div>

                @endif


                {{-- Problem Details --}}
                <div class="mt-5 flex flex-wrap items-center gap-3">

                    <span class="px-3 py-1 rounded-lg
                                 bg-slate-100 text-slate-600 text-sm">
                        Difficulty: {{ $problem->difficulty }}
                    </span>

                    <span class="px-3 py-1 rounded-lg
                                 bg-slate-100 text-slate-600 text-sm">
                        Solved {{ $problem->updated_at->format('d M Y') }}
                    </span>

                </div>

            </div>

        @empty

            {{-- Empty Search State --}}
            <div class="bg-white rounded-2xl
                        border border-slate-200
                        p-12 text-center">

                <div class="text-5xl mb-4">
                    🔎
                </div>

                @if($search)

                    <h3 class="text-xl font-bold text-slate-900">
                        No Solved Problems Found
                    </h3>

                    <p class="text-slate-500 mt-2 max-w-lg mx-auto">
                        We couldn't find a previously solved problem matching
                        "{{ $search }}".
                    </p>

                    <div class="mt-6">

                        <a href="{{ route('problems.create') }}"
                           class="inline-flex items-center gap-2
                                  bg-blue-600 hover:bg-blue-700
                                  text-white font-semibold
                                  px-5 py-3 rounded-xl
                                  shadow-sm hover:shadow-md
                                  transition">

                            + Post New Problem

                        </a>

                    </div>

                @else

                    <h3 class="text-xl font-bold text-slate-900">
                        No Solved Problems Yet
                    </h3>

                    <p class="text-slate-500 mt-2">
                        There are no solved problems available yet.
                    </p>

                @endif

            </div>

        @endforelse


        {{-- Back --}}
        <div class="mt-6">

            <a href="{{ route('student.dashboard') }}"
               class="text-blue-600 hover:text-blue-700 font-semibold">

                ← Back to Dashboard

            </a>

        </div>

    </div>

</x-app-layout>