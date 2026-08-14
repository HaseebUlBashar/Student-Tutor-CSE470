<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-slate-900">
            Review Report
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8 px-4">

        {{-- Report Information --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">

            <h1 class="text-xl font-bold text-slate-900 mb-6">
                Report Details
            </h1>

            <div class="space-y-4">

                <div>
                    <p class="text-sm text-slate-500">Reason</p>
                    <p class="font-semibold text-slate-900">
                        {{ ucfirst($report->reason) }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Reported User</p>
                    <p class="font-semibold text-slate-900">
                        {{ $report->reportedUser->name ?? 'Unknown User' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Reported By</p>
                    <p class="font-semibold text-slate-900">
                        {{ $report->reporter->name ?? 'Unknown User' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Description</p>

                    <div class="mt-2 bg-slate-50 rounded-lg p-4 text-slate-700 whitespace-pre-line">
                        {{ $report->description }}
                    </div>
                </div>

            </div>

        </div>


        {{-- Reported Content --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

            <h2 class="text-xl font-bold text-slate-900 mb-6">
                Reported Content
            </h2>

            @if($report->problem)

                <div class="space-y-4">

                    <div>
                        <p class="text-sm text-slate-500">Content Type</p>
                        <p class="font-semibold">
                            Problem
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Title</p>
                        <p class="font-semibold text-slate-900">
                            {{ $report->problem->title }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Description</p>

                        <div class="mt-2 bg-slate-50 rounded-lg p-4 text-slate-700 whitespace-pre-line">
                            {{ $report->problem->description }}
                        </div>

                    </div>

                </div>

            @elseif($report->solution)

                <div class="space-y-4">

                    <div>
                        <p class="text-sm text-slate-500">Content Type</p>
                        <p class="font-semibold">
                            Solution
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Problem</p>
                        <p class="font-semibold text-slate-900">
                            {{ $report->solution->problem->title ?? 'Unknown Problem' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Solution Description</p>

                        <div class="mt-2 bg-slate-50 rounded-lg p-4 text-slate-700 whitespace-pre-line">
                            {{ $report->solution->description ?? 'No description provided.' }}
                        </div>

                    </div>

                </div>

            @else

                <p class="text-slate-500">
                    The reported content is no longer available.
                </p>

            @endif

        </div>

    </div>

{{-- Admin Decision --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mt-6">

    <h2 class="text-xl font-bold text-slate-900 mb-2">
        Admin Decision
    </h2>

    <p class="text-sm text-slate-500 mb-6">
        Decide whether this report requires action or should be dismissed.
    </p>

    <form method="POST" action="{{ route('admin.reports.action', $report->id) }}">
        @csrf

        <label for="admin_note"
               class="block text-sm font-semibold text-slate-700 mb-2">
            Admin Note
        </label>

        <textarea
            id="admin_note"
            name="admin_note"
            rows="4"
            maxlength="2000"
            placeholder="Explain your decision..."
            class="w-full rounded-xl border-slate-300
                   focus:border-blue-500 focus:ring-blue-500">{{ old('admin_note') }}</textarea>

        @error('admin_note')
            <p class="text-sm text-red-600 mt-2">
                {{ $message }}
            </p>
        @enderror

        <div class="flex flex-col sm:flex-row gap-3 mt-6">

            <button
                type="submit"
                class="bg-red-600 hover:bg-red-700
                       text-white px-5 py-2.5
                       rounded-xl
                       font-semibold
                       transition">

                Take Action

            </button>

            <button
                type="submit"
                formaction="{{ route('admin.reports.dismiss', $report->id) }}"
                class="bg-slate-200 hover:bg-slate-300
                       text-slate-800 px-5 py-2.5
                       rounded-xl
                       font-semibold
                       transition">

                Dismiss Report

            </button>

        </div>

    </form>

</div>

</x-app-layout>