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

                        Administrator Portal

                    </p>

                    <h2 class="text-3xl md:text-4xl
                               font-extrabold
                               text-white">

                        Administrator Dashboard

                    </h2>

                    <p class="mt-3
                              text-blue-100
                              max-w-xl">

                        Review reports, manage inappropriate content,
                        and maintain a safe academic community.

                    </p>

                </div>

                {{-- Admin Icon --}}
                <div class="hidden sm:flex
                            w-20 h-20
                            rounded-2xl
                            bg-white/15
                            backdrop-blur-sm
                            border border-white/20
                            items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-10 h-10 text-white"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.5">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>

                    </svg>

                </div>

            </div>

        </div>

    </x-slot>


    {{-- ================= MAIN CONTENT ================= --}}

    <div class="min-h-screen bg-slate-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- Welcome --}}
            <div class="mb-8">

                <p class="text-sm font-medium
                          text-slate-500
                          uppercase
                          tracking-wider">

                    Welcome back

                </p>

                <h1 class="mt-1 text-3xl font-bold text-slate-900">

                    {{ auth()->user()->name }}

                    <span class="inline-block">👋</span>

                </h1>

                <p class="mt-2 text-slate-500">

                    Here's an overview of reports requiring your attention.

                </p>

            </div>


            {{-- ================= STATISTICS ================= --}}

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">

                {{-- Total Reports --}}
                <div class="bg-blue-200 rounded-2xl
                            border border-slate-200
                            p-6 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Total Reports
                            </p>

                            <p class="mt-2 text-3xl font-bold text-slate-900">
                                {{ $totalReports }}
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl
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
                                      d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v14H5V6a2 2 0 012-2z"/>

                            </svg>

                        </div>

                    </div>

                </div>

                {{-- Pending Reports --}}
                <div class="bg-amber-200 rounded-2xl
                            border border-slate-200
                            p-6 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Pending Reports
                            </p>

                            <p class="mt-2 text-3xl font-bold text-slate-900">
                                {{ $pendingReportsCount }}
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl
                                    bg-amber-50
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


                {{-- Resolved Reports --}}
                <div class="bg-emerald-200 rounded-2xl
                            border border-slate-200
                            p-6 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Resolved Reports
                            </p>

                            <p class="mt-2 text-3xl font-bold text-slate-900">
                                {{ $resolvedReportsCount }}
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl
                                    bg-emerald-50
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6 text-emerald-600"
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


                {{-- ================= STUDENTS ================= --}}

<div class="bg-slate-100 rounded-2xl border border-slate-200
            shadow-sm overflow-hidden mb-8">

    <div class="px-6 py-5 border-b border-slate-200
            flex items-center justify-between">

    <div>
        <h2 class="text-xl font-bold text-slate-900">
            Students
        </h2>

        <p class="text-sm text-slate-500 mt-1">
            Recently registered student accounts.
        </p>
    </div>

    <a href="{{ route('admin.users.students') }}"
       class="text-sm font-semibold text-blue-600
              hover:text-blue-800">

        See All →

    </a>

</div>


    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-left text-xs
                               font-semibold text-slate-500 uppercase">
                        ID
                    </th>

                    <th class="px-6 py-4 text-left text-xs
                               font-semibold text-slate-500 uppercase">
                        User
                    </th>

                    <th class="px-6 py-4 text-left text-xs
                               font-semibold text-slate-500 uppercase">
                        Problems
                    </th>

                    <th class="px-6 py-4 text-left text-xs
                               font-semibold text-slate-500 uppercase">
                        Reports
                    </th>

                    <th class="px-6 py-4 text-left text-xs
                               font-semibold text-slate-500 uppercase">
                        Warnings
                    </th>

                    <th class="px-6 py-4 text-left text-xs
                               font-semibold text-slate-500 uppercase">
                        Status
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-slate-100">

                @forelse($students as $student)

                    <tr class="hover:bg-slate-50 cursor-pointer"
                        onclick="window.location='{{ route('admin.users.show', $student) }}'">

                        <td class="px-6 py-4 text-sm font-medium">
                            #{{ $student->id }}
                        </td>

                        <td class="px-6 py-4">

                            <p class="font-semibold text-slate-900">
                                {{ $student->name }}
                            </p>

                            <p class="text-sm text-slate-500">
                                {{ $student->email }}
                            </p>

                        </td>

                        <td class="px-6 py-4 text-sm">
                            {{ $student->problems_count }}
                        </td>

                        <td class="px-6 py-4 text-sm">
                            {{ $student->reports_received_count }}
                        </td>

                        <td class="px-6 py-4 text-sm">
                            {{ $student->warnings_count }}
                        </td>

                        <td class="px-6 py-4">

                            <span class="px-3 py-1 rounded-lg text-xs
                                font-semibold
                                {{ $student->account_status === 'active'
                                    ? 'bg-emerald-50 text-emerald-700'
                                    : ($student->account_status === 'suspended'
                                        ? 'bg-amber-50 text-amber-700'
                                        : 'bg-red-50 text-red-700') }}">

                                {{ ucfirst($student->account_status) }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="px-6 py-10 text-center text-slate-500">

                            No students found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- ================= STUDENT TUTORS ================= --}}

<div class="bg-slate-200 rounded-2xl border border-slate-200
            shadow-sm overflow-hidden mb-8">

    <div class="px-6 py-5 border-b border-slate-200
            flex items-center justify-between">

    <div>
        <h2 class="text-xl font-bold text-slate-900">
            Student Tutors
        </h2>

        <p class="text-sm text-slate-500 mt-1">
            Recently registered student tutor accounts.
        </p>
    </div>

    <a href="{{ route('admin.users.tutors') }}"
       class="text-sm font-semibold text-blue-600
              hover:text-blue-800">

        See All →

    </a>

</div>


    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-left text-xs
                               font-semibold text-slate-500 uppercase">
                        ID
                    </th>

                    <th class="px-6 py-4 text-left text-xs
                               font-semibold text-slate-500 uppercase">
                        User
                    </th>

                    <th class="px-6 py-4 text-left text-xs
                               font-semibold text-slate-500 uppercase">
                        Solved
                    </th>

                    <th class="px-6 py-4 text-left text-xs
                               font-semibold text-slate-500 uppercase">
                        Reports
                    </th>

                    <th class="px-6 py-4 text-left text-xs
                               font-semibold text-slate-500 uppercase">
                        Warnings
                    </th>

                    <th class="px-6 py-4 text-left text-xs
                               font-semibold text-slate-500 uppercase">
                        Status
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-slate-100">

                @forelse($studentTutors as $tutor)

                    <tr class="hover:bg-slate-50 cursor-pointer"
                        onclick="window.location='{{ route('admin.users.show', $tutor) }}'">

                        <td class="px-6 py-4 text-sm font-medium">
                            #{{ $tutor->id }}
                        </td>

                        <td class="px-6 py-4">

                            <p class="font-semibold text-slate-900">
                                {{ $tutor->name }}
                            </p>

                            <p class="text-sm text-slate-500">
                                {{ $tutor->email }}
                            </p>

                        </td>

                        <td class="px-6 py-4 text-sm">
                            {{ $tutor->solved_problems_count }}
                        </td>

                        <td class="px-6 py-4 text-sm">
                            {{ $tutor->reports_received_count }}
                        </td>

                        <td class="px-6 py-4 text-sm">
                            {{ $tutor->warnings_count }}
                        </td>

                        <td class="px-6 py-4">

                            <span class="px-3 py-1 rounded-lg text-xs
                                font-semibold
                                {{ $tutor->account_status === 'active'
                                    ? 'bg-emerald-50 text-emerald-700'
                                    : ($tutor->account_status === 'suspended'
                                        ? 'bg-amber-50 text-amber-700'
                                        : 'bg-red-50 text-red-700') }}">

                                {{ ucfirst($tutor->account_status) }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="px-6 py-10 text-center text-slate-500">

                            No student tutors found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
            {{-- ================= REPORTS ================= --}}

            <div class="bg-pink-100 rounded-2xl
                        border border-slate-200
                        shadow-sm overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-5
                            border-b border-slate-200
                            flex flex-col sm:flex-row
                            sm:items-center
                            sm:justify-between
                            gap-3">

                    <div>

                        <h2 class="text-xl font-bold text-slate-900">
                            Pending Reports
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Review reports submitted by students and student tutors.
                        </p>

                    </div>

                </div>


                {{-- Report List --}}

                @forelse($pendingReports as $report)

                    <div class="px-6 py-6
                                border-b border-slate-100
                                hover:bg-slate-50
                                transition">

                        <div class="flex flex-col lg:flex-row
                                    lg:items-center
                                    lg:justify-between
                                    gap-5">

                            <div class="flex items-start gap-4">

                                {{-- Report Icon --}}
                                <div class="w-11 h-11
                                            rounded-xl
                                            bg-red-50
                                            text-red-600
                                            flex items-center justify-center
                                            shrink-0">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-6 h-6"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor"
                                         stroke-width="2">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M12 9v4m0 4h.01M10.29 3.86l-8.1 14a2 2 0 001.74 3h16.14a2 2 0 001.74-3l-8.1-14a2 2 0 00-3.42 0z"/>

                                    </svg>

                                </div>


                                <div>

                                    {{-- Reason --}}
                                    <div class="flex items-center gap-2 flex-wrap">

                                        <h3 class="font-bold text-slate-900">

                                            {{ ucfirst($report->reason) }}

                                        </h3>

                                        <span class="px-2.5 py-1
                                                     rounded-full
                                                     bg-amber-100
                                                     text-amber-700
                                                     text-xs
                                                     font-semibold">

                                            Pending

                                        </span>

                                    </div>


                                    {{-- Reported user --}}
                                    <p class="text-sm text-slate-600 mt-1">

                                        Reported user:

                                        <span class="font-semibold text-slate-900">

                                            {{ $report->reportedUser->name ?? 'Unknown User' }}

                                        </span>

                                    </p>


                                    {{-- Reporter --}}
                                    <p class="text-sm text-slate-500 mt-1">

                                        Reported by
                                        <span class="font-medium">
                                            {{ $report->reporter->name ?? 'Unknown User' }}
                                        </span>

                                    </p>


                                    {{-- Target --}}
                                    <p class="text-sm text-slate-500 mt-1">

                                        @if($report->problem)

                                            Problem:
                                            <span class="font-medium text-slate-700">
                                                {{ $report->problem->title }}
                                            </span>

                                        @elseif($report->solution)

                                            Solution submitted for:
                                            <span class="font-medium text-slate-700">
                                                {{ $report->solution->problem->title ?? 'Unknown Problem' }}
                                            </span>

                                        @endif

                                    </p>


                                    {{-- Description --}}
                                    <p class="text-sm text-slate-600 mt-3 max-w-2xl">

                                        {{ Str::limit($report->description, 180) }}

                                    </p>

                                </div>

                            </div>


                            {{-- Review Button --}}
                            <div class="lg:shrink-0">

                                <a
                                    href="{{ route('admin.reports.show', $report->id) }}"
                                    class="inline-flex items-center gap-2
                                        bg-blue-600
                                        hover:bg-blue-700
                                        text-white
                                        px-5 py-2.5
                                        rounded-xl
                                        text-sm
                                        font-semibold
                                        transition">

                                    Review Report

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

                    <div class="px-6 py-12 text-center">

                        <div class="w-14 h-14 mx-auto
                                    rounded-2xl
                                    bg-emerald-50
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-7 h-7 text-emerald-500"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="1.8">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M5 13l4 4L19 7"/>

                            </svg>

                        </div>

                        <h3 class="mt-4 font-semibold text-slate-900">
                            No Pending Reports
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            There are currently no reports requiring your attention.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</x-app-layout>
