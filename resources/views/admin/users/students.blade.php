<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">
                All Students
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Manage all registered student accounts.
            </p>
        </div>
    </x-slot>


    <div class="min-h-screen bg-slate-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">

                    <div>
                        <h1 class="text-xl font-bold text-slate-900">
                            Students
                        </h1>

                        <p class="text-sm text-slate-500 mt-1">
                            All registered students
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
                                    Problems
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

                            @forelse($students as $student)

                                <tr
                                    class="hover:bg-slate-50 cursor-pointer"
                                    onclick="window.location='{{ route('admin.users.show', $student) }}'"
                                >

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

                                        <span class="px-3 py-1 rounded-lg text-xs font-semibold
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


                <div class="px-6 py-5 border-t border-slate-200">

                    {{ $students->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
