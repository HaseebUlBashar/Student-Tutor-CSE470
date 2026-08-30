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
                    All Student Tutors
                </h2>

                <p class="text-sm text-slate-500">
                    Manage all registered student tutor accounts
                </p>

            </div>

        </div>

    </x-slot>


    <div class="min-h-screen bg-slate-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <div class="bg-blue-100 rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">

                    <div>
                        <h1 class="text-xl font-bold text-slate-900">
                            Student Tutors
                        </h1>

                        <p class="text-sm text-slate-500 mt-1">
                            All registered student tutors
                        </p>
                    </div>

                    <a href="{{ route('admin.dashboard') }}"
                       class="text-sm font-semibold text-blue-600 hover:text-blue-800">

                        ← Dashboard

                    </a>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-slate-50">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                                    ID
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                                    User
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                                    Solved
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                                    Reports
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                                    Warnings
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @forelse($studentTutors as $tutor)

                                <tr
                                    class="hover:bg-slate-50 cursor-pointer"
                                    onclick="window.location='{{ route('admin.users.show', $tutor) }}'"
                                >

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

                                        <span class="px-3 py-1 rounded-lg text-xs font-semibold
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


                <div class="px-6 py-5 border-t border-slate-200">

                    {{ $studentTutors->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
