<x-app-layout>

    {{-- ================= HEADER ================= --}}
    <x-slot name="header">

    <div class="relative overflow-hidden">

        <!-- Background decoration -->
        <div class="absolute -top-10 -right-10 w-40 h-40
                    bg-blue-100 rounded-full opacity-60">
        </div>

        <div class="absolute -bottom-16 -right-5 w-32 h-32
                    bg-indigo-100 rounded-full opacity-50">
        </div>


        <div class="relative flex items-center justify-between gap-6">

            <!-- Left Content -->
            <div>

                <!-- Small Label -->
                <div class="flex items-center gap-2 mb-2">

                    <span class="inline-flex items-center
                                 px-3 py-1
                                 rounded-full
                                 bg-blue-100
                                 text-blue-700
                                 text-xs
                                 font-bold
                                 uppercase
                                 tracking-wider">

                        Student Portal

                    </span>

                    <span class="w-2 h-2 rounded-full bg-green-500"></span>

                    <span class="text-xs text-gray-500 font-medium">
                        Active
                    </span>

                </div>


                <!-- Main Heading -->
                <h2 class="text-3xl md:text-4xl
                           font-extrabold
                           text-slate-900
                           tracking-tight">

                    Student Dashboard

                </h2>


                <!-- Description -->
                <p class="mt-2
                          text-blue-100
                          text-sm md:text-base
                          max-w-xl">

                    Manage your academic problems, track their progress,
                    and connect with student tutors.

                </p>

            </div>


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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-6">


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


        </div>

    </div>

</x-app-layout>
