<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold text-blue-600 uppercase tracking-wider">
                Solution Review
            </p>

            <h2 class="text-3xl font-bold text-slate-900 mt-1">
                Solutions for Your Problem
            </h2>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

        {{-- Success --}}
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200
                        text-green-700 px-5 py-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error --}}
        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200
                        text-red-700 px-5 py-4 rounded-xl">
                {{ session('error') }}
            </div>
        @endif


        {{-- Problem Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">

            <div class="flex items-start justify-between gap-4">

                <div>

                    <p class="text-sm text-slate-500">
                        {{ $problem->department }} · {{ $problem->course }}
                    </p>

                    <h1 class="text-2xl font-bold text-slate-900 mt-1">
                        {{ $problem->title }}
                    </h1>

                    <p class="text-slate-500 mt-2">
                        {{ $problem->chapter }}
                    </p>

                </div>

                <div>

                    @if($problem->status === 'Solved')

                        <span class="inline-flex items-center gap-2
                                     px-4 py-2 rounded-full
                                     bg-green-50 text-green-700
                                     font-semibold">

                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            Solved

                        </span>

                    @else

                        <span class="inline-flex items-center gap-2
                                     px-4 py-2 rounded-full
                                     bg-yellow-50 text-yellow-700
                                     font-semibold">

                            <span class="w-2 h-2 bg-yellow-500 rounded-full"></span>
                            In Progress

                        </span>

                    @endif

                </div>

            </div>

        </div>


        {{-- Solutions --}}
        <div>

            <div class="flex items-center justify-between mb-5">

                <div>

                    <h2 class="text-2xl font-bold text-slate-900">
                        Submitted Solutions
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Review the solutions submitted by Student Tutors.
                    </p>

                </div>

                <span class="px-3 py-1 rounded-full bg-blue-50
                             text-blue-700 font-semibold text-sm">
                    {{ $solutions->count() }} Solutions
                </span>

            </div>


            @forelse($solutions as $solution)

                <div class="bg-white rounded-2xl shadow-sm
                            border border-slate-200 p-6 mb-5">

                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <h3 class="text-lg font-bold text-slate-900">
                                {{ $solution->studentTutor->name }}
                            </h3>

                            <p class="text-sm text-slate-500">
                                {{ $solution->studentTutor->email }}
                            </p>

                        </div>


                        @if($solution->status === 'accepted')

                            <span class="px-3 py-1.5 rounded-full
                                         bg-green-50 text-green-700
                                         font-semibold text-sm">
                                ✓ Accepted
                            </span>

                        @elseif($solution->status === 'rejected')

                            <span class="px-3 py-1.5 rounded-full
                                         bg-red-50 text-red-700
                                         font-semibold text-sm">
                                Rejected
                            </span>

                        @else

                            <span class="px-3 py-1.5 rounded-full
                                         bg-yellow-50 text-yellow-700
                                         font-semibold text-sm">
                                Pending Review
                            </span>

                        @endif

                    </div>


                    <div class="mt-5 bg-slate-50 rounded-xl p-5">

                        <h4 class="font-semibold text-slate-800 mb-2">
                            Solution
                        </h4>

                        <p class="text-slate-700 whitespace-pre-line">
                            {{ $solution->description }}
                        </p>

                    </div>


                    @if($solution->attachment)

                        <div class="mt-4">

                            <a href="{{ asset('storage/' . $solution->attachment) }}"
                               target="_blank"
                               class="inline-flex items-center gap-2
                                      text-blue-600 hover:text-blue-700
                                      font-semibold">

                                📎 View Solution Attachment

                            </a>

                        </div>

                    @endif

                    @if(auth()->user()->role === 'student')

                        <div class="mt-4">

                            <a href="{{ route('reports.solution.create', $solution->id) }}"
                            class="inline-flex items-center gap-2
                                    text-red-600 hover:text-red-700
                                    font-semibold">

                                ⚠ Report Solution

                            </a>

                        </div>

                    @endif

                    @if($solution->submitted_at)

                        <p class="text-sm text-slate-400 mt-4">
                            Submitted
                            {{ $solution->submitted_at->format('d M Y, h:i A') }}
                        </p>

                    @endif


                    {{-- Accept --}}
                    @if($solution->status === 'submitted' && $problem->status !== 'Solved')

                        <div class="mt-6 pt-5 border-t border-slate-200">

                            <form method="POST"
                                  action="{{ route('solutions.accept', $solution->id) }}"
                                  onsubmit="return confirm('Are you sure you want to accept this solution? The problem will be marked as solved.')">

                                @csrf

                                <button type="submit"
                                        class="w-full bg-green-600 hover:bg-green-700
                                               text-white py-3 rounded-xl
                                               font-semibold transition">

                                    ✓ Accept This Solution

                                </button>

                            </form>

                        </div>

                    @endif
                    {{-- Rating & Review Section (Visible once solution is accepted) --}}
                    @if($solution->status === 'accepted' && auth()->user()->role === 'student')
                        <div class="mt-6 pt-5 border-t border-slate-200">
                            @php
                                $existingReview = \App\Models\Review::where('problem_id', $problem->id)
                                    ->where('reviewer_id', auth()->id())
                                    ->where('reviewed_id', $solution->student_tutor_id)
                                    ->first();
                            @endphp

                            @if($existingReview)
                                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                                    <div class="flex items-center justify-between">
                                        <h4 class="font-semibold text-blue-900">Your Review for this Tutor</h4>
                                        <span class="text-amber-500 font-semibold">
                                            {{ str_repeat('⭐', $existingReview->rating) }} ({{ $existingReview->rating }}/5)
                                        </span>
                                    </div>
                                    @if($existingReview->comment)
                                        <p class="text-sm text-blue-800 mt-2 italic">
                                            "{{ $existingReview->comment }}"
                                        </p>
                                    @endif
                                </div>
                            @else
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-5">
                                    <h4 class="font-bold text-slate-900 mb-1">Rate Tutor: {{ $solution->studentTutor->name }}</h4>
                                    <p class="text-xs text-slate-500 mb-4">Share your feedback to help the community know how helpful this tutor was.</p>

                                    <form action="{{ route('reviews.store', $problem->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="reviewed_id" value="{{ $solution->student_tutor_id }}">

                                        <div class="mb-3">
                                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Rating</label>
                                            <select name="rating" required class="w-full text-sm border-slate-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                <option value="">Select Star Rating</option>
                                                <option value="5">⭐⭐⭐⭐⭐ (5 - Excellent)</option>
                                                <option value="4">⭐⭐⭐⭐ (4 - Good)</option>
                                                <option value="3">⭐⭐⭐ (3 - Average)</option>
                                                <option value="2">⭐⭐ (2 - Poor)</option>
                                                <option value="1">⭐ (1 - Terrible)</option>
                                            </select>
                                        </div>

                                        <div class="mb-4">
                                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Feedback Comment (Optional)</label>
                                            <textarea name="comment" rows="2" class="w-full text-sm border-slate-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="How well did they explain the concept?"></textarea>
                                        </div>

                                        <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold text-sm transition">
                                            Submit Review
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endif

                </div>

            @empty

                <div class="bg-white rounded-2xl border border-slate-200
                            p-12 text-center">

                    <div class="text-5xl mb-4">
                        📭
                    </div>

                    <h3 class="text-xl font-bold text-slate-900">
                        No Solutions Yet
                    </h3>

                    <p class="text-slate-500 mt-2">
                        Student Tutors have not submitted any solutions
                        for this problem yet.
                    </p>

                </div>

            @endforelse

        </div>


        <div class="mt-6">

            <a href="{{ route('problems.index') }}"
               class="text-blue-600 hover:text-blue-700 font-semibold">

                ← Back to My Problems

            </a>

        </div>

    </div>

</x-app-layout>