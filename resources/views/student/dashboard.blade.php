<x-app-layout>

    {{-- ================= HEADER ================= --}}
    <x-slot name="header">

    <div class="relative overflow-hidden
                bg-gradient-to-br from-blue-700 via-blue-600 to-indigo-600
                rounded-3xl
                shadow-xl
                px-8 py-8 md:px-10 md:py-10">

            {{-- Decorative circles --}}
            <div class="absolute -top-20 -right-20
                        w-64 h-64
                        bg-white/10
                        rounded-full">
            </div>

            <div class="absolute -bottom-24 -left-16
                        w-48 h-48
                        bg-white/5
                        rounded-full">
            </div>

            <div class="relative flex items-center justify-between">

                <div>

                    <p class="text-sm font-semibold
                              text-blue-100
                              uppercase
                              tracking-widest
                              mb-2">

                        Student Portal

                    </p>

                    <h2 class="text-3xl md:text-4xl
                               font-extrabold
                               text-white">

                        Student Dashboard

                    </h2>

                    <p class="mt-3
                              text-blue-100
                              max-w-xl">

                    Manage your academic problems, track their progress,
                    and connect with student tutors.

                    </p>

                </div>

        <div class="relative flex items-center justify-between gap-6">

            <!-- Right Icon -->
            <div class="hidden sm:flex
                        relative
                        w-20 h-20
                        rounded-3xl
                        bg-gradient-to-br
                        from-blue-500
                        to-indigo-600
                        items-center
                        justify-center
                        shadow-lg
                        shadow-blue-200">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-10 h-10 text-white"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="1.7">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"/>

                </svg>

            </div>

        </div>

    </div>

</x-slot>


    {{-- ================= MAIN CONTENT ================= --}}

    <div class="min-h-screen bg-slate-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            {{-- ================= WELCOME ================= --}}

            <div class="flex flex-col md:flex-row md:items-center
                        md:justify-between gap-4 mb-8">

                <div>

                    <p class="text-sm text-slate-500">
                        Welcome back
                    </p>

                    <h1 class="text-2xl md:text-3xl font-bold text-slate-900">
                        {{ auth()->user()->name }} 👋
                    </h1>

                    <p class="mt-1 text-slate-500">
                        Here's an overview of your academic problems.
                    </p>

                </div>


                {{-- Post Problem Button --}}

                <a href="{{ route('problems.create') }}"
                   class="inline-flex items-center justify-center gap-2
                          bg-blue-600 hover:bg-blue-700
                          text-white font-semibold
                          px-5 py-3 rounded-xl
                          shadow-sm hover:shadow-md
                          transition duration-200">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 4v16m8-8H4"/>

                    </svg>

                    Post New Problem

                </a>

            </div>
            {{-- ================= NEW SOLUTIONS ================= --}}

<div class="mb-8">

    <div class="bg-white rounded-2xl border border-slate-200
                shadow-sm overflow-hidden">

        {{-- Notification Header --}}
        <div class="px-6 py-5 border-b border-slate-200
                    flex items-center justify-between">

            <div class="flex items-center gap-3">

                {{-- Bell Icon --}}
                <div class="w-11 h-11 rounded-xl
                            bg-blue-50
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-6 h-6 text-blue-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M15 17h5l-1.405-1.405A2.032
                                 2.032 0 0118 14.158V11a6.002
                                 6.002 0 00-4-5.659V5a2 2 0 10-4
                                 0v.341C7.67 6.165 6 8.388
                                 6 11v3.159c0 .538-.214 1.055
                                 -.595 1.436L4 17h5m6 0v1a3 3
                                 0 11-6 0v-1m6 0H9"/>

                    </svg>

                </div>


                <div>

                    <div class="flex items-center gap-2">

                        <h2 class="text-lg font-bold text-slate-900">
                            New Solutions
                        </h2>

                        @if($newSolutionsCount > 0)

                            <span class="inline-flex items-center justify-center
                                         min-w-6 h-6 px-2
                                         rounded-full
                                         bg-blue-600
                                         text-white
                                         text-xs
                                         font-bold">

                                {{ $newSolutionsCount }}

                            </span>

                        @endif

                    </div>

                    <p class="text-sm text-slate-500 mt-1">
                        Solutions submitted by Student Tutors for your problems.
                    </p>

                </div>

            </div>

        </div>


        {{-- Notification List --}}

        @forelse($newSolutions as $solution)

            <div class="px-6 py-5
                        border-b border-slate-100
                        hover:bg-slate-50
                        transition duration-150">

                <div class="flex flex-col sm:flex-row
                            sm:items-center
                            sm:justify-between
                            gap-4">

                    {{-- Notification Information --}}
                    <div class="flex items-start gap-4">

                        {{-- Tutor Icon --}}
                        <div class="w-10 h-10
                                    rounded-full
                                    bg-indigo-100
                                    text-indigo-700
                                    flex items-center justify-center
                                    font-bold
                                    shrink-0">

                            {{ strtoupper(substr($solution->studentTutor->name, 0, 1)) }}

                        </div>


                        <div>

                            <p class="text-sm text-slate-500">

                                New solution submitted for

                            </p>

                            <h3 class="font-bold text-slate-900">

                                {{ $solution->problem->title }}

                            </h3>

                            <p class="text-sm text-slate-600 mt-1">

                                Submitted by
                                <span class="font-semibold">
                                    {{ $solution->studentTutor->name }}
                                </span>

                            </p>

                            @if($solution->submitted_at)

                                <p class="text-xs text-slate-400 mt-1">

                                    {{ $solution->submitted_at->format('d M Y, h:i A') }}

                                </p>

                            @endif

                        </div>

                    </div>


                    {{-- View Solution Button --}}
                    <div class="sm:shrink-0">

                        <a href="{{ route('problems.solutions', $solution->problem->id) }}"
                           class="inline-flex items-center gap-2
                                  bg-blue-600
                                  hover:bg-blue-700
                                  text-white
                                  px-4 py-2.5
                                  rounded-xl
                                  text-sm
                                  font-semibold
                                  transition duration-200">

                            View Solution

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-4 h-4"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M9 5l7 7-7 7"/>

                            </svg>

                        </a>

                    </div>

                </div>

            </div>

        @empty

            {{-- No Notifications --}}
            <div class="px-6 py-10 text-center">

                <div class="w-14 h-14
                            mx-auto
                            rounded-2xl
                            bg-slate-100
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-7 h-7 text-slate-400"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.8">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M15 17h5l-1.405-1.405A2.032
                                 2.032 0 0118 14.158V11a6.002
                                 6.002 0 00-4-5.659V5a2 2
                                 0 10-4 0v.341C7.67 6.165
                                 6 8.388 6 11v3.159c0
                                 .538-.214 1.055-.595
                                 1.436L4 17h5m6 0v1a3
                                 3 0 11-6 0v-1m6 0H9"/>

                    </svg>

                </div>

                <h3 class="mt-4 font-semibold text-slate-900">
                    No New Solutions
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    You don't have any new solutions to review right now.
                </p>

            </div>

        @endforelse

    </div>

</div>

            {{-- ================= STATISTICS ================= --}}

            <div class="grid grid-cols-1 sm:grid-cols-2
                        lg:grid-cols-4 gap-5 mb-8">


                {{-- Total Problems --}}
                <div class="bg-white rounded-2xl border border-slate-200
                            p-6 shadow-sm hover:shadow-md
                            transition duration-200">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Total Problems
                            </p>

                            <p class="mt-2 text-3xl font-bold text-slate-900">
                                {{ $totalProblems }}
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-blue-50
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6 text-blue-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v14H5V6a2 2 0 012-2z"/>

                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Open --}}
                <div class="bg-white rounded-2xl border border-slate-200
                            p-6 shadow-sm hover:shadow-md
                            transition duration-200">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Open
                            </p>

                            <p class="mt-2 text-3xl font-bold text-slate-900">
                                {{ $openProblems }}
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-emerald-50
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6 text-emerald-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M5 12h14"/>

                            </svg>

                        </div>

                    </div>

                </div>


                {{-- In Progress --}}
                <div class="bg-white rounded-2xl border border-slate-200
                            p-6 shadow-sm hover:shadow-md
                            transition duration-200">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                In Progress
                            </p>

                            <p class="mt-2 text-3xl font-bold text-slate-900">
                                {{ $inProgressProblems }}
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-amber-50
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6 text-amber-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M12 8v4l3 2"/>

                                <circle cx="12"
                                        cy="12"
                                        r="9"/>

                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Solved --}}
                <div class="bg-white rounded-2xl border border-slate-200
                            p-6 shadow-sm hover:shadow-md
                            transition duration-200">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Solved
                            </p>

                            <p class="mt-2 text-3xl font-bold text-slate-900">
                                {{ $solvedProblems }}
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-purple-50
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6 text-purple-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M5 13l4 4L19 7"/>

                            </svg>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================= RECENT PROBLEMS ================= --}}

            <div class="bg-white rounded-2xl border border-slate-200
                        shadow-sm overflow-hidden">

                {{-- Header --}}

                <div class="px-6 py-5 border-b border-slate-200
                            flex flex-col sm:flex-row
                            sm:items-center sm:justify-between gap-3">

                    <div>

                        <h2 class="text-xl font-bold text-slate-900">
                            Recent Problems
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Your most recently posted academic problems.
                        </p>

                    </div>


                    <a href="{{ route('problems.index') }}"
                       class="text-sm font-semibold text-blue-600
                              hover:text-blue-700">

                        View All Problems →

                    </a>

                </div>


                {{-- Table --}}

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-slate-50">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs
                                           font-semibold text-slate-500
                                           uppercase tracking-wider">
                                    Title
                                </th>

                                <th class="px-6 py-4 text-left text-xs
                                           font-semibold text-slate-500
                                           uppercase tracking-wider">
                                    Course
                                </th>

                                <th class="px-6 py-4 text-left text-xs
                                           font-semibold text-slate-500
                                           uppercase tracking-wider">
                                    Reward
                                </th>

                                <th class="px-6 py-4 text-left text-xs
                                           font-semibold text-slate-500
                                           uppercase tracking-wider">
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @forelse($recentProblems as $problem)

                                <tr class="hover:bg-slate-50
                                           transition duration-150">

                                    {{-- Title --}}

                                    <td class="px-6 py-4">

                                        <p class="font-semibold text-slate-900">
                                            {{ $problem->title }}
                                        </p>

                                        <p class="text-xs text-slate-500 mt-1">
                                            {{ $problem->department }}
                                        </p>

                                    </td>


                                    {{-- Course --}}

                                    <td class="px-6 py-4">

                                        <span class="inline-flex items-center
                                                     px-3 py-1 rounded-lg
                                                     bg-blue-50 text-blue-700
                                                     text-sm font-semibold">

                                            {{ $problem->course }}

                                        </span>

                                    </td>


                                    {{-- Reward --}}

                                    <td class="px-6 py-4">

                                        <span class="font-semibold text-slate-800">

                                            ৳{{ number_format($problem->reward, 2) }}

                                        </span>

                                    </td>


                                    {{-- Status --}}

                                    <td class="px-6 py-4">

                                        @if($problem->status === 'Open')

                                            <span class="inline-flex items-center
                                                         px-3 py-1 rounded-full
                                                         bg-emerald-50
                                                         text-emerald-700
                                                         text-xs font-semibold">

                                                <span class="w-2 h-2
                                                             bg-emerald-500
                                                             rounded-full mr-2">
                                                </span>

                                                Open

                                            </span>

                                        @elseif($problem->status === 'In Progress')

                                            <span class="inline-flex items-center
                                                         px-3 py-1 rounded-full
                                                         bg-amber-50
                                                         text-amber-700
                                                         text-xs font-semibold">

                                                <span class="w-2 h-2
                                                             bg-amber-500
                                                             rounded-full mr-2">
                                                </span>

                                                In Progress

                                            </span>

                                        @elseif($problem->status === 'Solved')

                                            <span class="inline-flex items-center
                                                         px-3 py-1 rounded-full
                                                         bg-purple-50
                                                         text-purple-700
                                                         text-xs font-semibold">

                                                <span class="w-2 h-2
                                                             bg-purple-500
                                                             rounded-full mr-2">
                                                </span>

                                                Solved

                                            </span>

                                        @elseif($problem->status === 'Expired')

                                            <span class="inline-flex items-center
                                                         px-3 py-1 rounded-full
                                                         bg-red-50
                                                         text-red-700
                                                         text-xs font-semibold">

                                                <span class="w-2 h-2
                                                             bg-red-500
                                                             rounded-full mr-2">
                                                </span>

                                                Expired

                                            </span>

                                        @else

                                            <span class="text-sm text-slate-600">
                                                {{ $problem->status }}
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4"
                                        class="px-6 py-14 text-center">

                                        <div class="w-16 h-16 mx-auto
                                                    rounded-2xl bg-blue-50
                                                    flex items-center justify-center">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="w-8 h-8 text-blue-600"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor"
                                                 stroke-width="2">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M12 4v16m8-8H4"/>

                                            </svg>

                                        </div>

                                        <h3 class="mt-4 text-lg font-semibold
                                                   text-slate-900">

                                            No problems yet

                                        </h3>

                                        <p class="mt-1 text-sm text-slate-500">

                                            You haven't posted any academic
                                            problems yet.

                                        </p>

                                        <a href="{{ route('problems.create') }}"
                                           class="inline-flex mt-5
                                                  bg-blue-600 hover:bg-blue-700
                                                  text-white px-5 py-2.5
                                                  rounded-xl font-semibold
                                                  transition">

                                            + Post New Problem

                                        </a>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- ================= QUICK ACTIONS ================= --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-8 mb-8">


                {{-- Need Help --}}

                <div class="bg-gradient-to-r from-blue-600 to-blue-700
                            rounded-2xl p-6 text-white shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <h3 class="text-lg font-bold">
                                Need academic help?
                            </h3>

                            <p class="mt-1 text-blue-100 text-sm">
                                Post your problem and let a student tutor
                                help you.
                            </p>

                        </div>

                        <div class="hidden sm:flex w-12 h-12
                                    rounded-xl bg-white/10
                                    items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M12 4v16m8-8H4"/>

                            </svg>

                        </div>

                    </div>

                    <a href="{{ route('problems.create') }}"
                       class="inline-flex mt-4 bg-white text-blue-700
                              px-4 py-2 rounded-lg
                              text-sm font-semibold
                              hover:bg-blue-50 transition">

                        Post a Problem →

                    </a>

                </div>


                {{-- Manage Problems --}}

                <div class="bg-white border border-slate-200
                            rounded-2xl p-6 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <h3 class="text-lg font-bold text-slate-900">
                                Manage Your Problems
                            </h3>

                            <p class="mt-1 text-slate-500 text-sm">
                                View and manage all the problems you have posted.
                            </p>

                        </div>

                        <div class="hidden sm:flex w-12 h-12
                                    rounded-xl bg-slate-100
                                    items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6 text-slate-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 5h6"/>

                            </svg>

                        </div>

                    </div>

                    <a href="{{ route('problems.index') }}"
                       class="inline-flex mt-4 text-blue-600
                              hover:text-blue-700
                              text-sm font-semibold">

                        View All Problems →

                    </a>

                </div>

            </div>

            {{-- ================= REPORT UPDATES ================= --}}

            <div class="mt-8 mb-8">

                <div class="bg-white rounded-2xl border border-slate-200
                            shadow-sm overflow-hidden">

                    {{-- Report Updates Header --}}
                    <div class="px-6 py-5 border-b border-slate-200
                                flex items-center gap-3">

                        <div class="w-11 h-11 rounded-xl
                                    bg-blue-50
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-blue-600"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2
                                        0 01-2-2V5a2 2 0 012-2h5.586
                                        a1 1 0 01.707.293l5.414 5.414
                                        a1 1 0 01.293.707V19a2 2
                                        0 01-2 2z"/>

                            </svg>

                        </div>

                        <div>

                            <h2 class="text-lg font-bold text-slate-900">
                                Report Updates
                            </h2>

                            <p class="text-sm text-slate-500 mt-1">
                                Updates about the reports you have submitted.
                            </p>

                        </div>

                    </div>


                    {{-- Report Update List --}}

                    @forelse($reportUpdates as $report)

                        <div class="px-6 py-5
                                    border-b border-slate-100
                                    last:border-b-0
                                    hover:bg-slate-50
                                    transition">

                            <div class="flex items-start gap-4">

                                {{-- Status Icon --}}

                                @if($report->status === 'action_taken')

                                    <div class="w-10 h-10 rounded-full
                                                bg-green-100
                                                flex items-center justify-center
                                                shrink-0">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5 text-green-600"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 13l4 4L19 7"/>

                                        </svg>

                                    </div>

                                @else

                                    <div class="w-10 h-10 rounded-full
                                                bg-slate-100
                                                flex items-center justify-center
                                                shrink-0">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5 text-slate-500"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12"/>

                                        </svg>

                                    </div>

                                @endif


                                {{-- Report Information --}}

                                <div class="flex-1">

                                    @if($report->status === 'action_taken')

                                        <h3 class="font-semibold text-green-700">
                                            Action Taken
                                        </h3>

                                        <p class="mt-1 text-sm text-slate-600">
                                            Your report has been reviewed and
                                            appropriate action has been taken.
                                        </p>

                                    @else

                                        <h3 class="font-semibold text-slate-700">
                                            Report Dismissed
                                        </h3>

                                        <p class="mt-1 text-sm text-slate-600">
                                            Your report has been reviewed and
                                            was dismissed by the administrator.
                                        </p>

                                    @endif


                                    {{-- Admin Note --}}

                                    @if($report->admin_note)

                                        <p class="mt-2 text-sm text-slate-500">
                                            <span class="font-semibold">
                                                Admin note:
                                            </span>

                                            {{ $report->admin_note }}
                                        </p>

                                    @endif


                                    {{-- Date --}}

                                    @if($report->updated_at)

                                        <p class="mt-2 text-xs text-slate-400">
                                            {{ $report->updated_at->diffForHumans() }}
                                        </p>

                                    @endif

                                </div>


                                {{-- Status Badge --}}

                                @if($report->status === 'action_taken')

                                    <span class="hidden sm:inline-flex
                                                px-3 py-1
                                                rounded-full
                                                bg-green-100
                                                text-green-700
                                                text-xs
                                                font-semibold">

                                        Action Taken

                                    </span>

                                @else

                                    <span class="hidden sm:inline-flex
                                                px-3 py-1
                                                rounded-full
                                                bg-slate-100
                                                text-slate-600
                                                text-xs
                                                font-semibold">

                                        Dismissed

                                    </span>

                                @endif

                            </div>

                        </div>

                    @empty

                        {{-- No Report Updates --}}

                        <div class="px-6 py-10 text-center">

                            <div class="w-14 h-14
                                        mx-auto
                                        rounded-2xl
                                        bg-slate-100
                                        flex items-center justify-center">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-7 h-7 text-slate-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2
                                            0 01-2-2V5a2 2 0 012-2h5.586
                                            a1 1 0 01.707.293l5.414
                                            5.414a1 1 0 01.293.707V19a2
                                            2 0 01-2 2z"/>

                                </svg>

                            </div>

                            <h3 class="mt-4 font-semibold text-slate-900">
                                No Report Updates
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                You don't have any updates on your submitted reports yet.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>
            {{-- ================= WARNINGS ================= --}}

            <div class="mt-8 mb-8">

                <div class="bg-white rounded-2xl border border-slate-200
                            shadow-sm overflow-hidden">

                    {{-- Warning Header --}}
                    <div class="px-6 py-5 border-b border-slate-200
                                flex items-center gap-3">

                        <div class="w-11 h-11 rounded-xl
                                    bg-red-50
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-red-600"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01M10.29 3.86l-7.5 13A1 1 0 003.66 18h16.68a1 1 0 00.87-1.5l-7.5-13a1 1 0 00-1.74 0z"/>

                            </svg>

                        </div>

                        <div>

                            <h2 class="text-lg font-bold text-slate-900">
                                Warnings
                            </h2>

                            <p class="text-sm text-slate-500 mt-1">
                                Warnings issued to your account by an administrator.
                            </p>

                        </div>

                    </div>


                    {{-- Warning List --}}

                    @forelse($warnings as $warning)

                        <div class="px-6 py-5
                                    border-b border-slate-100
                                    last:border-b-0
                                    hover:bg-slate-50
                                    transition">

                            <div class="flex items-start gap-4">

                                {{-- Warning Icon --}}

                                <div class="w-10 h-10 rounded-full
                                            bg-red-100
                                            flex items-center justify-center
                                            shrink-0">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 text-red-600"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 9v2m0 4h.01M10.29 3.86l-7.5 13A1 1 0 003.66 18h16.68a1 1 0 00.87-1.5l-7.5-13a1 1 0 00-1.74 0z"/>

                                    </svg>

                                </div>


                                {{-- Warning Information --}}

                                <div class="flex-1">

                                    @if(
                                        $warning->report &&
                                        $warning->report->reported_content_title
                                    )

                                        <h3 class="font-semibold text-red-700">
                                            Content Removed & Warning Issued
                                        </h3>

                                        <p class="mt-1 text-sm text-slate-600">
                                            After reviewing a report concerning your account,
                                            the reported content was removed and a warning
                                            has been issued. For more information, please contact the support team and check the report details.
                                        </p>

                                    @else

                                        <h3 class="font-semibold text-red-700">
                                            Warning Issued
                                        </h3>

                                        <p class="mt-1 text-sm text-slate-600">
                                            After reviewing a report concerning your account,
                                            a warning has been issued. For more information, please contact the support team and check the report details.
                                        </p>

                                    @endif


                                    @if($warning->created_at)

                                        <p class="mt-2 text-xs text-slate-400">
                                            {{ $warning->created_at->diffForHumans() }}
                                        </p>

                                    @endif

                                </div>


                                {{-- Badge --}}

                                <span class="hidden sm:inline-flex
                                            px-3 py-1
                                            rounded-full
                                            bg-red-100
                                            text-red-700
                                            text-xs
                                            font-semibold">

                                    Warning

                                </span>

                            </div>

                        </div>

                    @empty

                        {{-- No Warnings --}}

                        <div class="px-6 py-10 text-center">

                            <div class="w-14 h-14
                                        mx-auto
                                        rounded-2xl
                                        bg-slate-100
                                        flex items-center justify-center">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-7 h-7 text-slate-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01M10.29 3.86l-7.5 13A1 1 0 003.66 18h16.68a1 1 0 00.87-1.5l-7.5-13a1 1 0 00-1.74 0z"/>

                                </svg>

                            </div>

                            <h3 class="mt-4 font-semibold text-slate-900">
                                No Warnings
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                You currently have no warnings.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>
        </div>

    </div>

</x-app-layout>
