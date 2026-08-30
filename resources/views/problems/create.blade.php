<x-app-layout>

    <!-- Header -->
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
                        d="M12 4v16m8-8H4"/>

                </svg>

            </div>

            <div>

                <h2 class="text-2xl font-bold text-slate-900">
                    Post Academic Problem
                </h2>

                <p class="text-sm text-slate-500">
                    Share your academic problem and get help from student tutors
                </p>

            </div>

        </div>

    </x-slot>


    <!-- Main Content -->
    <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <!-- Intro Card -->
        <div class="mb-6">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl bg-blue-100
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 text-blue-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 6v12m6-6H6"/>

                    </svg>

                </div>

                <div>
                    <h3 class="text-lg font-bold text-slate-900">
                        Problem Details
                    </h3>

                    <p class="text-sm text-slate-500">
                        Provide the details of the problem you need help with.
                    </p>
                </div>

            </div>

        </div>


        <!-- Form Card -->
        <div class="bg-blue-100 rounded-2xl shadow-lg
                    border border-slate-100 overflow-hidden">

            <form method="POST"
                  action="{{ route('problems.store') }}"
                  enctype="multipart/form-data"
                  class="p-6 sm:p-8 space-y-8">

                @csrf


                <!-- Academic Information -->
                <div>

                    <h3 class="text-lg font-bold text-slate-900 mb-5">
                        Academic Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        <!-- Department -->
                        <div>

                            <label for="department"
                                   class="block text-sm font-semibold text-slate-700 mb-2">
                                Department
                            </label>

                            <select
                                name="department"
                                id="department"
                                required
                                class="w-full rounded-xl border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       bg-white py-3 px-4">

                                <option value="">
                                    Select Department
                                </option>

                                <option value="CSE"
                                    {{ old('department') == 'CSE' ? 'selected' : '' }}>
                                    CSE
                                </option>

                                <option value="BBA"
                                    {{ old('department') == 'BBA' ? 'selected' : '' }}>
                                    BBA
                                </option>

                                <option value="EEE"
                                    {{ old('department') == 'EEE' ? 'selected' : '' }}>
                                    EEE
                                </option>

                            </select>

                            @error('department')
                                <p class="text-red-600 text-sm mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <!-- Course -->
                        <div>

                            <label for="course"
                                   class="block text-sm font-semibold text-slate-700 mb-2">
                                Course
                            </label>

                            <select
                                name="course"
                                id="course"
                                required
                                class="w-full rounded-xl border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       bg-white py-3 px-4">

                                <option value="">
                                    Select Department First
                                </option>

                            </select>

                            @error('course')
                                <p class="text-red-600 text-sm mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <!-- Chapter -->
                        <div>

                            <label for="chapter"
                                   class="block text-sm font-semibold text-slate-700 mb-2">
                                Chapter
                            </label>

                            <input
                                type="text"
                                name="chapter"
                                id="chapter"
                                value="{{ old('chapter') }}"
                                placeholder="e.g. Binary Trees"
                                required
                                class="w-full rounded-xl border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       py-3 px-4">

                            @error('chapter')
                                <p class="text-red-600 text-sm mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <!-- Difficulty -->
                        <div>

                            <label for="difficulty"
                                   class="block text-sm font-semibold text-slate-700 mb-2">
                                Difficulty
                            </label>

                            <select
                                name="difficulty"
                                id="difficulty"
                                required
                                class="w-full rounded-xl border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       bg-white py-3 px-4">

                                <option value="Easy"
                                    {{ old('difficulty') == 'Easy' ? 'selected' : '' }}>
                                    Easy
                                </option>

                                <option value="Medium"
                                    {{ old('difficulty') == 'Medium' ? 'selected' : '' }}>
                                    Medium
                                </option>

                                <option value="Hard"
                                    {{ old('difficulty') == 'Hard' ? 'selected' : '' }}>
                                    Hard
                                </option>

                            </select>

                            @error('difficulty')
                                <p class="text-red-600 text-sm mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <!-- Reward -->
                        <div>

                            <label for="reward"
                                   class="block text-sm font-semibold text-slate-700 mb-2">
                                Reward
                            </label>

                            <div class="relative">

                                <span class="absolute left-4 top-1/2
                                             -translate-y-1/2
                                             text-slate-500 font-medium">
                                    ৳
                                </span>

                                <input
                                    type="number"
                                    name="reward"
                                    id="reward"
                                    min="0"
                                    step="0.01"
                                    value="{{ old('reward') }}"
                                    placeholder="1000"
                                    required
                                    class="w-full rounded-xl border-slate-300
                                           focus:border-blue-500 focus:ring-blue-500
                                           py-3 pl-9 pr-4">

                            </div>

                            <p class="text-xs text-slate-500 mt-2">
                                Set a reward amount for the tutor who solves your problem.
                            </p>

                            @error('reward')
                                <p class="text-red-600 text-sm mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <!-- Deadline -->
                        <div>

                            <label for="deadline"
                                   class="block text-sm font-semibold text-slate-700 mb-2">
                                Deadline
                            </label>

                            <input
                                type="date"
                                name="deadline"
                                id="deadline"
                                value="{{ old('deadline') }}"
                                required
                                class="w-full rounded-xl border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       py-3 px-4">

                            @error('deadline')
                                <p class="text-red-600 text-sm mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>


                <!-- Problem Information -->
                <div class="border-t border-slate-100 pt-8">

                    <h3 class="text-lg font-bold text-slate-900 mb-5">
                        Problem Information
                    </h3>


                    <!-- Title -->
                    <div class="mb-6">

                        <label for="title"
                               class="block text-sm font-semibold text-slate-700 mb-2">
                            Problem Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title') }}"
                            placeholder="Give your problem a clear title"
                            required
                            class="w-full rounded-xl border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   py-3 px-4">

                        @error('title')
                            <p class="text-red-600 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <!-- Description -->
                    <div>

                        <label for="description"
                               class="block text-sm font-semibold text-slate-700 mb-2">
                            Description
                        </label>

                        <textarea
                            rows="7"
                            name="description"
                            id="description"
                            placeholder="Explain your problem clearly. Include any relevant details, questions, or things you have already tried."
                            required
                            class="w-full rounded-xl border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   py-3 px-4 resize-none">{{ old('description') }}</textarea>

                        @error('description')
                            <p class="text-red-600 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                <!-- Attachment -->
                <div class="border-t border-slate-100 pt-8">

                    <h3 class="text-lg font-bold text-slate-900 mb-2">
                        Attachment
                    </h3>

                    <p class="text-sm text-slate-500 mb-4">
                        Upload an image or document if it helps explain your problem.
                    </p>

                    <div class="border-2 border-dashed border-slate-300
                                rounded-2xl p-6
                                hover:border-blue-400
                                hover:bg-blue-50/30
                                transition">

                        <div class="flex flex-col sm:flex-row
                                    items-center gap-4">

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
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>

                                </svg>

                            </div>

                            <div class="flex-1 w-full">

                                <label for="attachment"
                                       class="block text-sm font-semibold text-slate-700 mb-2">
                                    Upload Image / PDF / Document
                                </label>

                                <input
                                    type="file"
                                    name="attachment"
                                    id="attachment"
                                    accept=".jpg,.jpeg,.png,.pdf,.doc,.docx"
                                    class="block w-full text-sm text-slate-600
                                           file:mr-4 file:py-2.5 file:px-4
                                           file:rounded-lg file:border-0
                                           file:text-sm file:font-semibold
                                           file:bg-blue-50 file:text-blue-700
                                           hover:file:bg-blue-100">

                                <p class="text-xs text-slate-500 mt-2">
                                    Supported: JPG, JPEG, PNG, PDF, DOC, DOCX · Maximum 5 MB
                                </p>

                            </div>

                        </div>

                    </div>

                    @error('attachment')
                        <p class="text-red-600 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Buttons -->
                <div class="border-t border-slate-100 pt-6
                            flex flex-col sm:flex-row gap-3">

                    <button
                        type="submit"
                        class="flex-1 inline-flex items-center justify-center
                               gap-2 bg-blue-600 hover:bg-blue-700
                               text-white py-3.5 px-6
                               rounded-xl font-semibold
                               shadow-md shadow-blue-200
                               hover:shadow-lg
                               transition-all duration-200">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 4v16m8-8H4"/>

                        </svg>

                        Submit Problem

                    </button>


                    <a
                        href="{{ route('student.dashboard') }}"
                        class="sm:w-40 inline-flex items-center justify-center
                               bg-slate-100 hover:bg-slate-200
                               text-slate-700 py-3.5 px-6
                               rounded-xl font-semibold
                               transition">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>


    <!-- Department → Course Script -->
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


        const departmentSelect =
            document.getElementById('department');

        const courseSelect =
            document.getElementById('course');


        function updateCourses() {

            const selectedDepartment =
                departmentSelect.value;

            courseSelect.innerHTML = '';


            if (selectedDepartment === '') {

                courseSelect.innerHTML =
                    '<option value="">Select Department First</option>';

                return;
            }


            courseSelect.innerHTML =
                '<option value="">Select Course</option>';


            courses[selectedDepartment].forEach(function(course) {

                const option =
                    document.createElement('option');

                option.value = course;
                option.textContent = course;

                courseSelect.appendChild(option);

            });

        }


        departmentSelect.addEventListener(
            'change',
            updateCourses
        );


        // Restore selected course after validation error
        const oldCourse =
            @json(old('course'));


        if (departmentSelect.value !== '') {

            updateCourses();

            if (oldCourse) {

                courseSelect.value = oldCourse;

            }

        }

    </script>

</x-app-layout>
