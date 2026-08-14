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

            <div class="relative">

                <p class="text-sm font-semibold
                          text-blue-100
                          uppercase
                          tracking-widest
                          mb-2">

                    Safety & Moderation

                </p>

                <h2 class="text-3xl md:text-4xl
                           font-extrabold
                           text-white">

                    Report {{ $solution ? 'Solution' : 'Problem' }}

                </h2>

                <p class="mt-3
                          text-blue-100
                          max-w-xl">

                    Help keep the Student Tutor platform safe,
                    respectful, and trustworthy.

                </p>

            </div>

        </div>

    </x-slot>


    {{-- ================= MAIN CONTENT ================= --}}

    <div class="min-h-screen bg-slate-50">

        <div class="max-w-3xl mx-auto
                    px-4 sm:px-6 lg:px-8
                    py-10">


            {{-- ================= ERROR MESSAGE ================= --}}

            @if ($errors->any())

                <div class="mb-6
                            bg-red-50
                            border border-red-200
                            rounded-2xl
                            p-5">

                    <div class="flex items-start gap-3">

                        <div class="w-10 h-10
                                    rounded-xl
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
                                      d="M12 9v4m0 4h.01M10.29 3.86
                                         L1.82 18a2 2 0 001.71 3h16.94
                                         a2 2 0 001.71-3L13.71 3.86
                                         a2 2 0 00-3.42 0z"/>

                            </svg>

                        </div>

                        <div>

                            <h3 class="font-semibold text-red-800">
                                Please check the form
                            </h3>

                            <ul class="mt-1 text-sm text-red-700 list-disc list-inside">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- ================= REPORT CARD ================= --}}

            <div class="bg-white
                        rounded-3xl
                        border border-slate-200
                        shadow-sm
                        overflow-hidden">


                {{-- Card Header --}}

                <div class="px-6 py-6
                            md:px-8
                            border-b border-slate-200">

                    <div class="flex items-start gap-4">

                        <div class="w-12 h-12
                                    rounded-2xl
                                    bg-red-50
                                    flex items-center justify-center
                                    shrink-0">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6 text-red-500"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M12 9v4m0 4h.01M10.29 3.86
                                         L1.82 18a2 2 0 001.71 3h16.94
                                         a2 2 0 001.71-3L13.71 3.86
                                         a2 2 0 00-3.42 0z"/>

                            </svg>

                        </div>

                        <div>

                            <h1 class="text-xl font-bold text-slate-900">

                                Tell us what happened

                            </h1>

                            <p class="mt-1 text-sm text-slate-500">

                                Please provide accurate information.
                                Reports are reviewed by an administrator.

                            </p>

                        </div>

                    </div>

                </div>


                {{-- ================= REPORTED CONTENT ================= --}}

                <div class="px-6 py-6 md:px-8">

                    <div class="mb-7">

                        <p class="text-sm
                                  font-semibold
                                  text-slate-500
                                  uppercase
                                  tracking-wider
                                  mb-3">

                            Reported {{ $solution ? 'Solution' : 'Problem' }}

                        </p>


                        <div class="rounded-2xl
                                    bg-slate-50
                                    border border-slate-200
                                    p-5">

                            @if($solution)

                                {{-- Solution --}}

                                <div class="flex items-center gap-3 mb-4">

                                    <div class="w-10 h-10
                                                rounded-full
                                                bg-indigo-100
                                                text-indigo-700
                                                flex items-center justify-center
                                                font-bold">

                                        {{ strtoupper(substr($solution->studentTutor->name ?? 'U', 0, 1)) }}

                                    </div>

                                    <div>

                                        <p class="text-xs text-slate-500">
                                            Submitted by
                                        </p>

                                        <p class="font-semibold text-slate-900">

                                            {{ $solution->studentTutor->name ?? 'Unknown User' }}

                                        </p>

                                    </div>

                                </div>


                                <p class="text-xs
                                          font-medium
                                          text-slate-500
                                          mb-1">

                                    Problem

                                </p>

                                <p class="font-semibold text-slate-900">

                                    {{ $problem->title }}

                                </p>


                                @if($solution->description)

                                    <div class="mt-4">

                                        <p class="text-xs
                                                  font-medium
                                                  text-slate-500
                                                  mb-1">

                                            Solution

                                        </p>

                                        <p class="text-sm
                                                  text-slate-700
                                                  whitespace-pre-line">

                                            {{ $solution->description }}

                                        </p>

                                    </div>

                                @endif


                            @else

                                {{-- Problem --}}

                                <div class="flex items-center gap-3 mb-4">

                                    <div class="w-10 h-10
                                                rounded-full
                                                bg-blue-100
                                                text-blue-700
                                                flex items-center justify-center
                                                font-bold">

                                        {{ strtoupper(substr($problem->user->name ?? 'U', 0, 1)) }}

                                    </div>

                                    <div>

                                        <p class="text-xs text-slate-500">
                                            Posted by
                                        </p>

                                        <p class="font-semibold text-slate-900">

                                            {{ $problem->user->name ?? 'Unknown User' }}

                                        </p>

                                    </div>

                                </div>


                                <p class="text-lg
                                          font-bold
                                          text-slate-900">

                                    {{ $problem->title }}

                                </p>


                                <p class="mt-2
                                          text-sm
                                          text-slate-600
                                          whitespace-pre-line">

                                    {{ $problem->description }}

                                </p>

                            @endif

                        </div>

                    </div>


                    {{-- ================= HIDDEN IDS ================= --}}

                    <input type="hidden"
                           name="problem_id"
                           value="{{ $problem->id }}">

                    @if($solution)

                        <input type="hidden"
                               name="solution_id"
                               value="{{ $solution->id }}">

                    @endif


                    {{-- ================= REPORT FORM ================= --}}

                    <form method="POST"
                          action="{{ route('reports.store') }}">

                        @csrf


                        <input type="hidden"
                               name="problem_id"
                               value="{{ $problem->id }}">


                        @if($solution)

                            <input type="hidden"
                                   name="solution_id"
                                   value="{{ $solution->id }}">

                            <input type="hidden"
                                   name="reported_user_id"
                                   value="{{ $solution->student_tutor_id }}">

                        @else

                            <input type="hidden"
                                   name="reported_user_id"
                                   value="{{ $problem->user_id }}">

                        @endif


                        {{-- ================= REASON ================= --}}

                        <div class="mb-7">

                            <label for="reason"
                                   class="block
                                          text-sm
                                          font-semibold
                                          text-slate-900
                                          mb-2">

                                Why are you reporting this?

                            </label>

                            <select id="reason"
                                    name="reason"
                                    required
                                    class="w-full
                                           rounded-xl
                                           border-slate-300
                                           focus:border-blue-500
                                           focus:ring-blue-500
                                           text-slate-700
                                           py-3">

                                <option value="">
                                    Select a reason
                                </option>

                                <option value="inappropriate"
                                    {{ old('reason') === 'inappropriate' ? 'selected' : '' }}>
                                    Inappropriate
                                </option>

                                <option value="misleading"
                                    {{ old('reason') === 'misleading' ? 'selected' : '' }}>
                                    Misleading
                                </option>

                                <option value="plagiarized"
                                    {{ old('reason') === 'plagiarized' ? 'selected' : '' }}>
                                    Plagiarized
                                </option>

                                <option value="abusive"
                                    {{ old('reason') === 'abusive' ? 'selected' : '' }}>
                                    Abusive
                                </option>

                            </select>

                        </div>


                        {{-- ================= DESCRIPTION ================= --}}

                        <div class="mb-7">

                            <label for="description"
                                   class="block
                                          text-sm
                                          font-semibold
                                          text-slate-900
                                          mb-2">

                                Explain your report

                            </label>

                            <textarea id="description"
                                      name="description"
                                      rows="6"
                                      required
                                      minlength="10"
                                      maxlength="2000"
                                      placeholder="Please explain clearly why you believe this should be reported..."
                                      class="w-full
                                             rounded-xl
                                             border-slate-300
                                             focus:border-blue-500
                                             focus:ring-blue-500
                                             text-slate-700
                                             placeholder-slate-400
                                             resize-none">{{ old('description') }}</textarea>

                            <div class="mt-2 flex justify-between gap-4">

                                <p class="text-xs text-slate-500">

                                    Please provide specific and truthful information.

                                </p>

                                <p class="text-xs text-slate-400">

                                    10–2000 characters

                                </p>

                            </div>

                        </div>


                        {{-- ================= PLAGIARISM NOTICE ================= --}}

                        <div class="mb-7
                                    rounded-2xl
                                    bg-amber-50
                                    border border-amber-200
                                    p-5">

                            <div class="flex items-start gap-3">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5 text-amber-600 mt-0.5 shrink-0"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 9v4m0 4h.01M10.29 3.86
                                             L1.82 18a2 2 0 001.71 3h16.94
                                             a2 2 0 001.71-3L13.71 3.86
                                             a2 2 0 00-3.42 0z"/>

                                </svg>

                                <div>

                                    <p class="text-sm
                                              font-semibold
                                              text-amber-800">

                                        Reporting plagiarism?

                                    </p>

                                    <p class="mt-1
                                              text-sm
                                              text-amber-700">

                                        Please explain why you believe the
                                        content was copied. For example,
                                        mention another solution that appears
                                        identical or substantially similar.

                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- ================= ACTIONS ================= --}}

                        <div class="flex flex-col-reverse
                                    sm:flex-row
                                    sm:justify-end
                                    gap-3">

                            @if($solution)

                                <a href="{{ route('tutor.problems.show', $solution->problem_id) }}"
                                   class="inline-flex
                                          items-center
                                          justify-center
                                          px-5 py-3
                                          rounded-xl
                                          border border-slate-300
                                          text-slate-700
                                          font-semibold
                                          hover:bg-slate-50
                                          transition">

                                    Cancel

                                </a>

                            @else

                                <a href="{{ route('problems.show', $problem->id) }}"
                                   class="inline-flex
                                          items-center
                                          justify-center
                                          px-5 py-3
                                          rounded-xl
                                          border border-slate-300
                                          text-slate-700
                                          font-semibold
                                          hover:bg-slate-50
                                          transition">

                                    Cancel

                                </a>

                            @endif


                            <button type="submit"
                                    class="inline-flex
                                           items-center
                                           justify-center
                                           gap-2
                                           px-5 py-3
                                           rounded-xl
                                           bg-red-600
                                           hover:bg-red-700
                                           text-white
                                           font-semibold
                                           shadow-sm
                                           hover:shadow-md
                                           transition">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 9v4m0 4h.01M10.29 3.86
                                             L1.82 18a2 2 0 001.71 3h16.94
                                             a2 2 0 001.71-3L13.71 3.86
                                             a2 2 0 00-3.42 0z"/>

                                </svg>

                                Submit Report

                            </button>

                        </div>

                    </form>

                </div>

            </div>


            {{-- ================= INFORMATION ================= --}}

            <div class="mt-6
                        rounded-2xl
                        bg-blue-50
                        border border-blue-100
                        p-5">

                <div class="flex items-start gap-3">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 text-blue-600 mt-0.5 shrink-0"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M13 16h-1v-4h-1m1-4h.01M21 12
                                 a9 9 0 11-18 0 9 9 0 0118 0z"/>

                    </svg>

                    <div>

                        <p class="text-sm
                                  font-semibold
                                  text-blue-800">

                            What happens after you report?

                        </p>

                        <p class="mt-1
                                  text-sm
                                  text-blue-700">

                            Your report will be reviewed by an administrator.
                            Reports are investigated before any action is taken.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>