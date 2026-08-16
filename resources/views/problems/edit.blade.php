<x-app-layout>

    {{-- =====================================================
         HEADER
    ====================================================== --}}
    <x-slot name="header">

        <div class="relative overflow-hidden">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-semibold text-blue-600 uppercase tracking-wider mb-1">
                        Student Portal
                    </p>

                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">
                        Edit Academic Problem
                    </h2>

                    <p class="mt-2 text-slate-500">
                        Update the details of your academic problem.
                    </p>

                </div>


                {{-- Decorative Icon --}}
                <div class="hidden sm:flex w-16 h-16
                            rounded-2xl
                            bg-blue-50
                            items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-9 h-9 text-blue-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.8">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-8.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 8.5-8.5z"/>

                    </svg>

                </div>

            </div>

        </div>

    </x-slot>


    {{-- =====================================================
         MAIN CONTENT
    ====================================================== --}}
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">


        {{-- =================================================
             FORM CARD
        ================================================== --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">


            {{-- Card Header --}}
            <div class="px-6 sm:px-8 py-6 border-b border-slate-200 bg-slate-50">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-xl
                                bg-blue-100
                                flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6 text-blue-600"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-8.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 8.5-8.5z"/>

                        </svg>

                    </div>

                    <div>

                        <h3 class="text-xl font-bold text-slate-900">
                            Problem Details
                        </h3>

                        <p class="text-sm text-slate-500 mt-1">
                            Make changes to your problem information below.
                        </p>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 FORM
            ================================================== --}}
            <form method="POST"
                  action="{{ route('problems.update', $problem->id) }}"
                  enctype="multipart/form-data"
                  class="p-6 sm:p-8 space-y-8">

                @csrf
                @method('PUT')


                {{-- =================================================
                     BASIC INFORMATION
                ================================================== --}}
                <div>

                    <div class="flex items-center gap-3 mb-5">

                        <div class="w-8 h-8 rounded-lg
                                    bg-blue-50
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-4 h-4 text-blue-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"/>

                            </svg>

                        </div>

                        <h3 class="text-lg font-bold text-slate-900">
                            Basic Information
                        </h3>

                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        {{-- Department --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Department
                            </label>

                            <select
                                name="department"
                                id="department"
                                required
                                class="w-full rounded-xl border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       transition">

                                <option value="">Select Department</option>

                                <option value="CSE"
                                    {{ old('department', $problem->department) == 'CSE' ? 'selected' : '' }}>
                                    CSE
                                </option>

                                <option value="BBA"
                                    {{ old('department', $problem->department) == 'BBA' ? 'selected' : '' }}>
                                    BBA
                                </option>

                                <option value="EEE"
                                    {{ old('department', $problem->department) == 'EEE' ? 'selected' : '' }}>
                                    EEE
                                </option>

                            </select>

                            @error('department')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Course --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Course
                            </label>

                            <select
                                name="course"
                                id="course"
                                required
                                class="w-full rounded-xl border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       transition">

                                <option value="">Select Course</option>

                            </select>

                            @error('course')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Chapter --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Chapter
                            </label>

                            <input
                                type="text"
                                name="chapter"
                                value="{{ old('chapter', $problem->chapter) }}"
                                required
                                placeholder="e.g. Binary Search"
                                class="w-full rounded-xl border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       transition">

                            @error('chapter')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Difficulty --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Difficulty
                            </label>

                            <select
                                name="difficulty"
                                required
                                class="w-full rounded-xl border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       transition">

                                <option value="Easy"
                                    {{ old('difficulty', $problem->difficulty) == 'Easy' ? 'selected' : '' }}>
                                    Easy
                                </option>

                                <option value="Medium"
                                    {{ old('difficulty', $problem->difficulty) == 'Medium' ? 'selected' : '' }}>
                                    Medium
                                </option>

                                <option value="Hard"
                                    {{ old('difficulty', $problem->difficulty) == 'Hard' ? 'selected' : '' }}>
                                    Hard
                                </option>

                            </select>

                            @error('difficulty')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Reward --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Reward (BDT)
                            </label>

                            <div class="relative">

                                <span class="absolute left-4 top-1/2
                                             -translate-y-1/2
                                             text-slate-500 font-semibold">
                                    ৳
                                </span>

                                <input
                                    type="number"
                                    name="reward"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('reward', $problem->reward) }}"
                                    required
                                    class="w-full pl-9 rounded-xl border-slate-300
                                           focus:border-blue-500 focus:ring-blue-500
                                           transition">

                            </div>

                            @error('reward')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Deadline --}}
                        <div>

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Deadline
                            </label>

                            <input
                                type="date"
                                name="deadline"
                                value="{{ old('deadline', $problem->deadline) }}"
                                required
                                class="w-full rounded-xl border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       transition">

                            @error('deadline')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     PROBLEM CONTENT
                ================================================== --}}
                <div class="border-t border-slate-200 pt-8">

                    <div class="flex items-center gap-3 mb-5">

                        <div class="w-8 h-8 rounded-lg
                                    bg-blue-50
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-4 h-4 text-blue-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M4 6h16M4 12h16M4 18h16"/>

                            </svg>

                        </div>

                        <h3 class="text-lg font-bold text-slate-900">
                            Problem Content
                        </h3>

                    </div>


                    {{-- Title --}}
                    <div class="mb-6">

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Problem Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $problem->title) }}"
                            required
                            placeholder="Enter a clear title for your problem"
                            class="w-full rounded-xl border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   transition">

                        @error('title')

                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Description --}}
                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Description
                        </label>

                        <textarea
                            rows="7"
                            name="description"
                            required
                            placeholder="Explain your problem in detail..."
                            class="w-full rounded-xl border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   transition resize-y">{{ old('description', $problem->description) }}</textarea>

                        @error('description')

                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>


                {{-- =================================================
                     ATTACHMENTS
                ================================================== --}}
                <div class="border-t border-slate-200 pt-8">

                    <div class="flex items-center gap-3 mb-5">

                        <div class="w-8 h-8 rounded-lg
                                    bg-blue-50
                                    flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-4 h-4 text-blue-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.414a4 4 0 00-5.656-5.656l-6.415 6.414a6 6 0 108.486 8.486L20.5 13"/>

                            </svg>

                        </div>

                        <h3 class="text-lg font-bold text-slate-900">
                            Attachment
                        </h3>

                    </div>


                    {{-- Current Attachment --}}
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 mb-5">

                        <p class="text-sm font-semibold text-slate-700 mb-3">
                            Current Attachment
                        </p>

                        @if($problem->attachment)

                            <div class="flex flex-col sm:flex-row
                                        sm:items-center
                                        sm:justify-between
                                        gap-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-lg
                                                bg-blue-100
                                                flex items-center justify-center">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-5 h-5 text-blue-600"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="2">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>

                                        </svg>

                                    </div>

                                    <div>

                                        <p class="text-sm font-semibold text-slate-800">
                                            {{ basename($problem->attachment) }}
                                        </p>

                                        <p class="text-xs text-slate-500">
                                            Current uploaded file
                                        </p>

                                    </div>

                                </div>


                                <a href="{{ asset('storage/' . $problem->attachment) }}"
                                   target="_blank"
                                   class="inline-flex items-center justify-center gap-2
                                          px-4 py-2
                                          rounded-lg
                                          bg-white
                                          border border-slate-300
                                          text-blue-600
                                          text-sm
                                          font-semibold
                                          hover:bg-blue-50
                                          transition">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-4 h-4"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor"
                                         stroke-width="2">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>

                                    </svg>

                                    View File

                                </a>

                            </div>

                        @else

                            <p class="text-sm text-slate-500">
                                No attachment has been uploaded for this problem.
                            </p>

                        @endif

                    </div>


                    {{-- Replace Attachment --}}
                    <div>

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Replace Attachment
                        </label>

                        <label class="flex flex-col items-center justify-center
                                      w-full
                                      min-h-36
                                      border-2 border-dashed
                                      border-slate-300
                                      rounded-xl
                                      cursor-pointer
                                      bg-slate-50
                                      hover:bg-blue-50
                                      hover:border-blue-400
                                      transition">

                            <div class="flex flex-col items-center justify-center">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-8 h-8 text-slate-400 mb-2"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="1.8">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 16V4m0 0l-4 4m4-4l4 4M4 16v3a1 1 0 001 1h14a1 1 0 001-1v-3"/>

                                </svg>

                                <p class="text-sm font-semibold text-slate-600">
                                    Click to upload a new file
                                </p>

                                <p class="text-xs text-slate-400 mt-1">
                                    JPG, PNG, PDF, DOC or DOCX
                                </p>

                            </div>

                            <input
                                type="file"
                                name="attachment"
                                class="hidden">

                        </label>

                        <p class="text-xs text-slate-500 mt-2">
                            Leave this empty if you want to keep the current attachment.
                        </p>

                        @error('attachment')

                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>


                {{-- =================================================
                     ACTION BUTTONS
                ================================================== --}}
                <div class="border-t border-slate-200 pt-6">

                    <div class="flex flex-col-reverse sm:flex-row gap-3">

                        {{-- Cancel --}}
                        <a href="{{ route('problems.index') }}"
                           class="flex-1 inline-flex items-center justify-center gap-2
                                  bg-slate-100
                                  hover:bg-slate-200
                                  text-slate-700
                                  py-3
                                  rounded-xl
                                  font-semibold
                                  transition">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M6 18L18 6M6 6l12 12"/>

                            </svg>

                            Cancel

                        </a>


                        {{-- Update --}}
                        <button
                            type="submit"
                            class="flex-1 inline-flex items-center justify-center gap-2
                                   bg-blue-600
                                   hover:bg-blue-700
                                   text-white
                                   py-3
                                   rounded-xl
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
                                      d="M5 13l4 4L19 7"/>

                            </svg>

                            Update Problem

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- =====================================================
         COURSE DROPDOWN SCRIPT
    ====================================================== --}}
    <script>

        const courses = {

            CSE: [
                "CSE220",
                "CSE321",
                "CSE420"
            ],

            BBA: [
                "BUS101",
                "BUS201",
                "MKT102"
            ],

            EEE: [
                "EEE201",
                "EEE310",
                "EEE420"
            ]

        };


        const departmentSelect = document.getElementById('department');
        const courseSelect = document.getElementById('course');

        const currentDepartment =
            "{{ old('department', $problem->department) }}";

        const currentCourse =
            "{{ old('course', $problem->course) }}";


        function loadCourses(department, selectedCourse = '') {

            courseSelect.innerHTML =
                '<option value="">Select Course</option>';

            if (!department || !courses[department]) {
                return;
            }

            courses[department].forEach(function(course) {

                const option = document.createElement('option');

                option.value = course;
                option.textContent = course;

                if (course === selectedCourse) {
                    option.selected = true;
                }

                courseSelect.appendChild(option);

            });

        }


        // Load courses when page opens
        loadCourses(currentDepartment, currentCourse);


        // Change courses when department changes
        departmentSelect.addEventListener('change', function() {

            loadCourses(this.value);

        });

    </script>

</x-app-layout>
