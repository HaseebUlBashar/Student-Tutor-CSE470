<x-app-layout>

    <x-slot name="header">

        <h2 class="text-2xl font-bold text-slate-900">
            Student Tutor Details
        </h2>

    </x-slot>

    <div class="min-h-screen bg-slate-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- USER INFORMATION --}}

            <div class="bg-white rounded-2xl border border-slate-200
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


            {{-- SOLVED PROBLEMS --}}

            <div class="bg-white rounded-2xl border border-slate-200
                        shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-200">

                    <h2 class="text-xl font-bold text-slate-900">
                        Problems Solved
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Problems solved by this student tutor.
                    </p>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-slate-50">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs
                                           font-semibold text-slate-500
                                           uppercase">
                                    Problem ID
                                </th>

                                <th class="px-6 py-4 text-left text-xs
                                           font-semibold text-slate-500
                                           uppercase">
                                    Problem
                                </th>

                                <th class="px-6 py-4 text-left text-xs
                                           font-semibold text-slate-500
                                           uppercase">
                                    Course
                                </th>

                                <th class="px-6 py-4 text-left text-xs
                                           font-semibold text-slate-500
                                           uppercase">
                                    Reward
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

                                        <td class="px-6 py-4 text-sm">
                                            #{{ $solution->problem->id }}
                                        </td>

                                        <td class="px-6 py-4">

                                            <p class="font-semibold text-slate-900">
                                                {{ $solution->problem->title }}
                                            </p>

                                            <p class="text-xs text-slate-500 mt-1">
                                                {{ $solution->problem->status }}
                                            </p>

                                        </td>

                                        <td class="px-6 py-4 text-sm">
                                            {{ $solution->problem->course }}
                                        </td>

                                        <td class="px-6 py-4 text-sm font-semibold">
                                            ৳{{ number_format($solution->reward, 2) }}
                                        </td>

                                        <td class="px-6 py-4">

                                            <div class="flex justify-end gap-2">

                                                <a href="{{ route('admin.problems.edit', $solution->problem) }}"
                                                   class="px-3 py-2 rounded-lg
                                                          bg-blue-50 text-blue-700
                                                          text-sm font-semibold">

                                                    Edit

                                                </a>

                                                <form method="POST"
                                                      action="{{ route('admin.problems.delete', $solution->problem) }}"
                                                      onsubmit="return confirm('Delete this problem?');">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="px-3 py-2 rounded-lg
                                                                   bg-red-50 text-red-700
                                                                   text-sm font-semibold">

                                                        Delete

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @endif

                            @empty

                                <tr>

                                    <td colspan="5"
                                        class="px-6 py-10 text-center
                                               text-slate-500">

                                        This tutor has not solved any problems.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
