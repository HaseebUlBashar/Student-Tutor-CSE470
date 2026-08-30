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
                      d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m7-8a4 4 0 100-8 4 4 0 000 8zm7-4a4 4 0 11-2.5 3.464M22 21v-2a4 4 0 00-3-3.874"/>

            </svg>

        </div>

        <div>

            <h2 class="text-2xl font-bold text-slate-900">
                Student Tutor Details
            </h2>

            <p class="text-sm text-slate-500">
                View student tutorinformation and activity
            </p>

        </div>

    </div>

</x-slot>

    <div class="min-h-screen bg-slate-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- USER INFORMATION --}}

            <div class="bg-purple-100 rounded-2xl border border-slate-200
                        shadow-sm p-6 mb-8">

                <div class="flex flex-col md:flex-row
                            md:items-center md:justify-between gap-5">

                    <div>

                        <p class="text-sm text-slate-500">
                            Student Tutor ID #{{ $user->id }}
                        </p>

                        <h1 class="mt-1 text-3xl font-bold text-slate-900">
                            {{ $user->name }}
                        </h1>

                        <p class="mt-2 text-slate-600">
                            {{ $user->email }}
                        </p>

                    </div>

                    @if($user->account_status === 'active')

                        <span class="inline-flex px-4 py-2 rounded-xl
                                     bg-emerald-50 text-emerald-700
                                     font-semibold">
                            Active
                        </span>

                    @elseif($user->account_status === 'suspended')

                        <span class="inline-flex px-4 py-2 rounded-xl
                                     bg-amber-50 text-amber-700
                                     font-semibold">
                            Suspended
                        </span>

                    @else

                        <span class="inline-flex px-4 py-2 rounded-xl
                                     bg-red-50 text-red-700
                                     font-semibold">
                            Banned
                        </span>

                    @endif

                </div>


                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">

                    <div class="bg-slate-50 rounded-xl p-4">

                        <p class="text-sm text-slate-500">
                            Problems Solved
                        </p>

                        <p class="text-2xl font-bold text-slate-900 mt-1">
                            {{ $user->solutions->whereIn('status', ['submitted', 'accepted'])->count() }}
                        </p>

                    </div>

                    <div class="bg-slate-50 rounded-xl p-4">

                        <p class="text-sm text-slate-500">
                            Reports
                        </p>

                        <p class="text-2xl font-bold text-slate-900 mt-1">
                            {{ $user->reportsReceived->count() }}
                        </p>

                    </div>

                    <div class="bg-slate-50 rounded-xl p-4">

                        <p class="text-sm text-slate-500">
                            Warnings
                        </p>

                        <p class="text-2xl font-bold text-slate-900 mt-1">
                            {{ $user->warnings->count() }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- SOLUTIONS SUBMITTED --}}

            <div class="bg-blue-100 rounded-2xl border border-slate-200
                        shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-200">

                    <h2 class="text-xl font-bold text-slate-900">
                        Solutions Submitted
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Solutions submitted by this student tutor.
                    </p>
                </div>


                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-slate-50">

                            <tr>

    <th class="px-6 py-4 text-left text-xs
               font-semibold text-slate-500
               uppercase">
        Solution ID
    </th>

    <th class="px-6 py-4 text-left text-xs
               font-semibold text-slate-500
               uppercase">
        Problem
    </th>

    <th class="px-6 py-4 text-left text-xs
               font-semibold text-slate-500
               uppercase">
        Solution
    </th>

    <th class="px-6 py-4 text-left text-xs
               font-semibold text-slate-500
               uppercase">
        Reward
    </th>

    <th class="px-6 py-4 text-left text-xs
               font-semibold text-slate-500
               uppercase">
        Status
    </th>

    <th class="px-6 py-4 text-right text-xs
               font-semibold text-slate-500
               uppercase">
        Actions
    </th>

</tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

    @forelse($user->solutions->whereIn('status', ['submitted', 'accepted']) as $solution)

        @if($solution->problem)

            <tr class="hover:bg-slate-50">

                {{-- Solution ID --}}
                <td class="px-6 py-4 text-sm font-semibold text-slate-700">
                    #{{ $solution->id }}
                </td>


                {{-- Original Problem --}}
                <td class="px-6 py-4">

                    <p class="font-semibold text-slate-900">
                        {{ $solution->problem->title }}
                    </p>

                    <p class="text-xs text-slate-500 mt-1">
                        Problem #{{ $solution->problem->id }}
                        ·
                        {{ $solution->problem->course }}
                    </p>

                </td>


                {{-- Solution Description --}}
                <td class="px-6 py-4">

                    <p class="text-sm text-slate-700 max-w-md">
                        {{ \Illuminate\Support\Str::limit(
                            $solution->description,
                            100
                        ) }}
                    </p>

                </td>


                {{-- Solution Attachment --}}



                {{-- Reward --}}
                <td class="px-6 py-4 text-sm font-semibold text-slate-900">

                    ৳{{ number_format($solution->reward, 2) }}

                </td>


                {{-- Status --}}
                <td class="px-6 py-4">

                    @if($solution->status === 'accepted')

                        <span class="px-3 py-1 rounded-full
                                     bg-emerald-50 text-emerald-700
                                     text-xs font-semibold">

                            Accepted

                        </span>

                    @elseif($solution->status === 'submitted')

                        <span class="px-3 py-1 rounded-full
                                     bg-blue-50 text-blue-700
                                     text-xs font-semibold">

                            Submitted

                        </span>

                    @endif

                </td>


                {{-- Actions --}}
                <td class="px-6 py-4">

                    <div class="flex justify-end gap-2">

                        <a
                            href="{{ route('admin.solutions.edit', $solution) }}"
                            class="px-3 py-2 rounded-lg
                                   bg-blue-50 text-blue-700
                                   text-sm font-semibold
                                   hover:bg-blue-100">

                            Edit

                        </a>


                        <form
                            method="POST"
                            action="{{ route('admin.solutions.delete', $solution) }}"
                            onsubmit="return confirm('Delete this solution?');"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="px-3 py-2 rounded-lg
                                       bg-red-50 text-red-700
                                       text-sm font-semibold
                                       hover:bg-red-100">

                                Delete

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @endif

    @empty

        <tr>

            <td
                colspan="7"
                class="px-6 py-10 text-center text-slate-500"
            >

                This tutor has not submitted any solutions.

            </td>

        </tr>

    @endforelse

</tbody>
                    </table>

                </div>

            </div>

        </div>
{{-- REPORTS AGAINST THIS USER --}}

<div class="bg-slate-100 rounded-2xl border border-slate-200
            shadow-sm overflow-hidden mt-8">

    <div class="px-6 py-5 border-b border-slate-200">

        <h2 class="text-xl font-bold text-slate-900">
            Reports Against This User
        </h2>

        <p class="text-sm text-slate-500 mt-1">
            Reports submitted against this student tutor.
        </p>

    </div>


    @forelse($user->reportsReceived as $report)

        <div class="px-6 py-6 border-b border-slate-100
                    hover:bg-slate-50 transition">

            <div class="flex flex-col lg:flex-row
                        lg:items-center
                        lg:justify-between
                        gap-5">

                <div>

                    <div class="flex items-center gap-3 flex-wrap">

                        <h3 class="font-bold text-slate-900">
                            {{ ucfirst($report->reason) }}
                        </h3>


                        @if($report->status === 'pending')

                            <span class="px-3 py-1 rounded-full
                                         bg-amber-100 text-amber-700
                                         text-xs font-semibold">

                                Pending

                            </span>

                        @elseif($report->status === 'action_taken')

                            <span class="px-3 py-1 rounded-full
                                         bg-red-100 text-red-700
                                         text-xs font-semibold">

                                Action Taken

                            </span>

                        @elseif($report->status === 'dismissed')

                            <span class="px-3 py-1 rounded-full
                                         bg-slate-100 text-slate-700
                                         text-xs font-semibold">

                                Dismissed

                            </span>

                        @endif

                    </div>


                    <p class="text-sm text-slate-600 mt-2">

                        Reported by:

                        <span class="font-semibold text-slate-900">
                            {{ $report->reporter->name ?? 'Unknown User' }}
                        </span>

                    </p>


                    <p class="text-sm text-slate-500 mt-2 max-w-2xl">

                        {{ \Illuminate\Support\Str::limit($report->description, 160) }}

                    </p>


                    <p class="text-xs text-slate-400 mt-2">

                        Reported
                        {{ $report->created_at->format('M d, Y') }}

                    </p>

                </div>


                <div class="shrink-0">

                    <a href="{{ route('admin.reports.show', $report) }}"
                       class="inline-flex items-center gap-2
                              bg-blue-600 hover:bg-blue-700
                              text-white px-4 py-2.5
                              rounded-xl text-sm
                              font-semibold transition">

                        Open Report

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

        <div class="px-6 py-10 text-center">

            <p class="text-slate-500">
                No reports have been submitted against this student tutor.
            </p>

        </div>

    @endforelse

</div>
    </div>

</x-app-layout>
