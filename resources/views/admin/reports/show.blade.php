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
                    Review Report
                </h2>

                <p class="text-sm text-slate-500">
                    Review the reported content and take appropriate action
                </p>

            </div>

        </div>

    </x-slot>

    <div class="max-w-5xl mx-auto py-8 px-4">

        {{-- Report Information --}}
        <div class="bg-amber-100 rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">

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
                    <p class="text-sm text-slate-500">Previous Warnings</p>
                    <p class="font-semibold text-slate-900">
                        {{ $previousWarningCount }}
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

@if($report->problem || $report->solution || $report->reported_content_title || $report->reported_content_description)

    <div class="bg-amber-50 rounded-2xl shadow-sm
                border border-slate-200 p-6">

        <h2 class="text-xl font-bold text-slate-900 mb-6">
            Reported Content
        </h2>


        @if($report->problem)

            <div class="space-y-4">

                <div>
                    <p class="text-sm text-slate-500">
                        Content Type
                    </p>

                    <p class="font-semibold">
                        Problem
                    </p>
                </div>


                <div>
                    <p class="text-sm text-slate-500">
                        Title
                    </p>

                    <p class="font-semibold text-slate-900">
                        {{ $report->problem->title }}
                    </p>
                </div>


                <div>
                    <p class="text-sm text-slate-500">
                        Description
                    </p>

                    <div class="mt-2 bg-slate-50 rounded-lg
                                p-4 text-slate-700
                                whitespace-pre-line">

                        {{ $report->problem->description }}

                    </div>
                </div>

            </div>


        @elseif($report->solution)

            <div class="space-y-4">

                <div>
                    <p class="text-sm text-slate-500">
                        Content Type
                    </p>

                    <p class="font-semibold">
                        Solution
                    </p>
                </div>


                <div>
                    <p class="text-sm text-slate-500">
                        Problem
                    </p>

                    <p class="font-semibold text-slate-900">
                        {{ $report->solution->problem->title ?? 'Unknown Problem' }}
                    </p>
                </div>


                <div>
                    <p class="text-sm text-slate-500">
                        Solution Description
                    </p>

                    <div class="mt-2 bg-slate-50 rounded-lg
                                p-4 text-slate-700
                                whitespace-pre-line">

                        {{ $report->solution->description ?? 'No description provided.' }}

                    </div>
                </div>

            </div>


        @elseif($report->reported_content_title ||
                $report->reported_content_description)

            {{-- Snapshot of deleted content --}}

            <div class="space-y-4">

                <div>
                    <p class="text-sm text-slate-500">
                        Content Type
                    </p>

                    <p class="font-semibold">
                        {{ $report->reported_content_type ?? 'Reported Content' }}
                    </p>
                </div>


                <div>
                    <p class="text-sm text-slate-500">
                        Title
                    </p>

                    <p class="font-semibold text-slate-900">
                        {{ $report->reported_content_title ?? 'No title available.' }}
                    </p>
                </div>


                <div>
                    <p class="text-sm text-slate-500">
                        Description
                    </p>

                    <div class="mt-2 bg-slate-50 rounded-lg
                                p-4 text-slate-700
                                whitespace-pre-line">

                        {{ $report->reported_content_description
                            ?? 'No description available.' }}

                    </div>
                </div>


                <div>
                    <span class="inline-flex px-3 py-1 rounded-full
                                 bg-slate-100 text-slate-600
                                 text-xs font-semibold">

                        Original content has been removed

                    </span>
                </div>

            </div>

        @endif

    </div>

@endif


{{-- ================= MESSAGE CONVERSATION ================= --}}

@if($report->message && $report->conversation)

    <div class="bg-white rounded-2xl shadow-sm
                border border-slate-200 p-6 mt-6">

        <h2 class="text-xl font-bold text-slate-900 mb-2">
            Conversation Thread
        </h2>

        <p class="text-sm text-slate-500 mb-6">
            Review the conversation to understand the context of the reported message.
        </p>

        <div class="space-y-3 max-h-96 overflow-y-auto">

            @foreach($report->conversation->messages as $message)

                <div class="rounded-xl p-4
                    {{ $message->id === $report->message_id
                        ? 'bg-red-50 border border-red-200'
                        : 'bg-slate-50 border border-slate-200' }}">

                    <div class="flex items-center justify-between gap-3 mb-1">

                        <p class="font-semibold text-slate-900">
                            {{ $message->sender->name ?? 'Unknown User' }}
                        </p>

                        <span class="text-xs text-slate-400">
                            {{ $message->created_at->format('d M, h:i A') }}
                        </span>

                    </div>

                    <p class="text-sm text-slate-700 whitespace-pre-line">
                        {{ $message->message }}
                    </p>

                    @if($message->id === $report->message_id)

                        <span class="inline-flex mt-2 px-2.5 py-1
                                     rounded-full
                                     bg-red-100 text-red-700
                                     text-xs font-semibold">

                            Reported Message

                        </span>

                    @endif

                </div>

            @endforeach

        </div>

    </div>

@endif

@if($report->status === 'pending')

    {{-- existing Admin Decision section here --}}

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mt-6">

    <h2 class="text-xl font-bold text-slate-900 mb-2">
        Admin Decision
    </h2>

    <p class="text-sm text-slate-500 mb-6">
        Select an action for this report and explain your decision.
    </p>

    <form method="POST"
          action="{{ route('admin.reports.action', $report->id) }}">

        @csrf

        {{-- Action --}}
        <div>

            <label for="action"
                   class="block text-sm font-semibold text-slate-700 mb-2">
                Action
            </label>

            <select id="action"
                    name="action"
                    required
                    class="w-full rounded-xl border-slate-300 mb-3
                           focus:border-blue-500 focus:ring-blue-500">

                <option value="">
                    Select an action
                </option>

                <option value="warn">
                    Warn User
                </option>

                @if(!$report->message)
                    <option value="remove_and_warn">
                        Remove Content & Warn User
                    </option>
                @endif

                <option value="suspend">
                    Suspend User
                </option>

                <option value="ban">
                    Permanently Ban User
                </option>

            </select>

            @error('action')
                <p class="text-sm text-red-600 mt-2">
                    {{ $message }}
                </p>
            @enderror

        </div>

        {{-- Suspension Duration --}}
        <div id="suspension-duration" class="mt-5 hidden">

            <label for="suspension_duration"
                   class="block text-sm font-semibold text-slate-700 mb-2">
                Suspension Duration
            </label>

            <select
                id="suspension_duration"
                name="suspension_duration"
                class="w-full rounded-xl border-slate-300
                       focus:border-blue-500 focus:ring-blue-500">

                <option value="">Select duration</option>
                <option value="1">1 Day</option>
                <option value="7">7 Days</option>
                <option value="30">30 Days</option>

            </select>

            @error('suspension_duration')
                <p class="text-sm text-red-600 mt-2">
                    {{ $message }}
                </p>
            @enderror

        </div>


        {{-- Admin Note --}}
        <div class="mb-6">

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

        </div>


        {{-- Buttons --}}
        <div class="flex flex-col sm:flex-row gap-3">

            <button
                type="submit"
                class="bg-red-600 hover:bg-red-700
                       text-white px-5 py-2.5
                       rounded-xl
                       font-semibold
                       transition">

                Apply Action

            </button>

            <button
                type="submit"
                formaction="{{ route('admin.reports.dismiss', $report->id) }}"
                formnovalidate
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
@else

    <div class="bg-white rounded-2xl shadow-sm
                border border-slate-200 p-6 mt-6">

        <h2 class="text-xl font-bold text-slate-900">
            Report Resolution
        </h2>

        <div class="mt-4">

            @if($report->status === 'action_taken')

                <span class="inline-flex px-3 py-1 rounded-full
                             bg-red-100 text-red-700
                             text-sm font-semibold">

                    Action Taken

                </span>

            @elseif($report->status === 'dismissed')

                <span class="inline-flex px-3 py-1 rounded-full
                             bg-slate-100 text-slate-700
                             text-sm font-semibold">

                    Report Dismissed

                </span>

            @endif

        </div>


        @if($report->admin_note)

            <div class="mt-5">

                <p class="text-sm font-semibold text-slate-600">
                    Admin Note
                </p>

                <div class="mt-2 bg-slate-50 rounded-xl p-4
                            text-slate-700 whitespace-pre-line">

                    {{ $report->admin_note }}

                </div>

            </div>

        @endif

    </div>

@endif



<script>
    const actionSelect = document.getElementById('action');
    const suspensionDuration = document.getElementById('suspension-duration');

    actionSelect.addEventListener('change', function () {
        if (this.value === 'suspend') {
            suspensionDuration.classList.remove('hidden');
        } else {
            suspensionDuration.classList.add('hidden');
        }
    });
</script>
</x-app-layout>
