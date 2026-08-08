<x-app-layout>

    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900">
            📚 Post Academic Problem
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-8">

        <div class="bg-white rounded-2xl shadow-xl p-8">

            <form method="POST"
                  action="{{ route('problems.store') }}"
                  enctype="multipart/form-data"
                  class="space-y-6">

                @csrf

                <div class="grid grid-cols-2 gap-6">

                <!-- Department -->
                <div>
                <label class="block font-semibold mb-2">
                    Department
                </label>

                <select
                    name="department"
                    id="department"
                    class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    required>

                    <option value="">Select Department</option>
                    <option value="CSE">CSE</option>
                    <option value="BBA">BBA</option>
                    <option value="EEE">EEE</option>

                </select>
            </div>
            <!-- Course -->
            <div>
                <label class="block font-semibold mb-2">
                    Course
                </label>

                <select
                    name="course"
                    id="course"
                    class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    required>

                    <option value="">Select Department First</option>

                </select>
            </div>
              <!-- Chapter -->

                    <div>
                        <label class="block font-semibold mb-2">
                            Chapter
                        </label>

                        <input
                            type="text"
                            name="chapter"
                            class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>
                       <!-- Difficulty -->
                    <div>
                        <label class="block font-semibold mb-2">
                            Difficulty
                        </label>

                        <select
                            name="difficulty"
                            class="w-full rounded-lg border-gray-300 focus:ring-blue-500"
                            required>

                            <option>Easy</option>
                            <option>Medium</option>
                            <option>Hard</option>

                        </select>
                    </div>
                       <!-- Reward -->
                    <div>
                        <label class="block font-semibold mb-2">
                            Reward (BDT)
                        </label>

                        <input
                            type="number"
                            name="reward"
                            class="w-full rounded-lg border-gray-300"
                            min="0"
                            required>
                    </div>
                       <!-- Deadline -->
                    <div>
                        <label class="block font-semibold mb-2">
                            Deadline
                        </label>

                        <input
                            type="date"
                            name="deadline"
                            class="w-full rounded-lg border-gray-300"
                            required>
                    </div>

                </div>

                <div>
                    <label class="block font-semibold mb-2">
                        Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="w-full rounded-lg border-gray-300"
                        required>
                </div>

                <div>
                    <label class="block font-semibold mb-2">
                        Description
                    </label>

                    <textarea
                        rows="6"
                        name="description"
                        class="w-full rounded-lg border-gray-300"
                        required></textarea>
                </div>

                <div>
                    <label class="block font-semibold mb-2">
                        Upload Image / PDF
                    </label>

                    <input
                        type="file"
                        name="attachment"
                        accept=".jpg,.jpeg,.png,.pdf,.doc,.docx"
                        class="block w-full text-gray-700">
                </div>

                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition">

                    Submit Problem

                </button>

            </form>

        </div>

    </div>
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

    departmentSelect.addEventListener('change', function () {

        const selectedDepartment = this.value;

        // Clear existing courses
        courseSelect.innerHTML = '';

        if (selectedDepartment === '') {

            courseSelect.innerHTML =
                '<option value="">Select Department First</option>';

            return;
        }

        // Add default option
        courseSelect.innerHTML =
            '<option value="">Select Course</option>';

        // Add courses for selected department
        courses[selectedDepartment].forEach(function(course) {

            const option = document.createElement('option');

            option.value = course;
            option.textContent = course;

            courseSelect.appendChild(option);
        });
    });
</script>
</x-app-layout>