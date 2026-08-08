<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-3xl font-bold text-gray-900">
                🔍 Browse Academic Problems
            </h2>
        </div>
    </x-slot>

<!----------------------------- Search Section  ----------------------------->
    <div class="max-w-7xl mx-auto py-8">
        <form method="GET" action="{{ route('tutor.problems') }}" class="bg-white rounded-2xl shadow-xl p-8 mb-6">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

        <div>
            <label for="department" class="block text-sm font-medium text-gray-700 mb-1">
                🏢 Department
            </label>

            <select
                name="department"
                id="department"
                class="w-full border-gray-300 rounded-lg"
            >
                <option value="">All Departments</option>
                <option value="CSE" {{ request('department') == 'CSE' ? 'selected' : '' }}>CSE</option>
                <option value="BBA" {{ request('department') == 'BBA' ? 'selected' : '' }}>BBA</option>
                <option value="EEE" {{ request('department') == 'EEE' ? 'selected' : '' }}>EEE</option>
            </select>
        </div>


        <div>
            <label for="course" class="block text-sm font-medium text-gray-700 mb-1">
                📔Course
            </label>

            <select
                name="course"
                id="course"
                class="w-full border-gray-300 rounded-lg">

                <option value="">All Courses</option>

            </select>
        </div>


        <div>
            <label for="reward" class="block text-sm font-medium text-gray-700 mb-1">
                💰 Reward Amount
            </label>

            <input
                type="number"
                name="reward"
                id="reward"
                step="0.01"
                min="0"
                value="{{ request('reward') }}"
                placeholder="Enter reward"
                class="w-full border-gray-300 rounded-lg"
            >
        </div>


        <div>
            <label for="deadline" class="block text-sm font-medium text-gray-700 mb-1">
                ⏳ Deadline
            </label>

            <input
                type="date"
                name="deadline"
                id="deadline"
                value="{{ request('deadline') }}"
                class="w-full border-gray-300 rounded-lg"
            >
        </div>

    </div>


    <div class="mt-5 flex gap-3">

        <button
            type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
        >
            Search
        </button>

        <a
            href="{{ route('tutor.problems') }}"
            class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300"
        >
            Reset
        </a>

    </div>

</form>
<!----------------------------- Filter Section  ----------------------------->
<div class="bg-white rounded-2xl shadow-xl p-8 mb-6">

    <details>
        <summary class="cursor-pointer font-semibold text-gray-800">
            🔬 Filter
        </summary>

        <form method="GET" action="{{ route('tutor.problems') }}" class="mt-6">

            {{-- Keep existing search values --}}
            @foreach(request()->only(['department', 'course', 'reward']) as $key => $value)
                @if($value !== null && $value !== '')
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endif
            @endforeach

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                <!-- Difficulty -->
                <div>
                    <label for="difficulty"
                           class="block text-sm font-medium text-gray-700 mb-1">
                        🏋️ Difficulty
                    </label>

                    <select
                        name="difficulty"
                        id="difficulty"
                        class="w-full border-gray-300 rounded-lg">

                        <option value="">All Difficulties</option>

                        <option value="Easy"
                            {{ request('difficulty') == 'Easy' ? 'selected' : '' }}>
                            🧠 Easy
                        </option>

                        <option value="Medium"
                            {{ request('difficulty') == 'Medium' ? 'selected' : '' }}>
                            🧠🧠 Medium
                        </option>

                        <option value="Hard"
                            {{ request('difficulty') == 'Hard' ? 'selected' : '' }}>
                            🧠🧠🧠 Hard
                        </option>

                    </select>
                </div>


                <!-- Minimum Reward -->
                <div>
                    <label for="min_reward"
                           class="block text-sm font-medium text-gray-700 mb-1">
                        💵 Minimum Reward (BDT)
                    </label>

                    <input
                        type="number"
                        name="min_reward"
                        id="min_reward"
                        min="0"
                        step="0.01"
                        value="{{ request('min_reward') }}"
                        placeholder="e.g. 500"
                        class="w-full border-gray-300 rounded-lg">
                </div>


                <!-- Maximum Reward -->
                <div>
                    <label for="max_reward"
                           class="block text-sm font-medium text-gray-700 mb-1">
                        💸 Maximum Reward (BDT)
                    </label>

                    <input
                        type="number"
                        name="max_reward"
                        id="max_reward"
                        min="0"
                        step="0.01"
                        value="{{ request('max_reward') }}"
                        placeholder="e.g. 1500"
                        class="w-full border-gray-300 rounded-lg">
                </div>


                <!-- Deadline -->
                <div>
                    <label for="filter_deadline"
                           class="block text-sm font-medium text-gray-700 mb-1">
                        ⏳ Deadline
                    </label>

                    <input
                        type="date"
                        name="deadline"
                        id="filter_deadline"
                        value="{{ request('deadline') }}"
                        class="w-full border-gray-300 rounded-lg">
                </div>

            </div>


            <div class="mt-5 flex gap-3">

                <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Apply Filters
                </button>

                <a
                    href="{{ route('tutor.problems') }}"
                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
                    Clear Filters
                </a>

            </div>

        </form>

    </details>

</div>
<!----------------------------- Sort Section  ----------------------------->
<div class="bg-white rounded-2xl shadow-xl p-8 mb-6">
    <form method="GET" action="{{ route('tutor.problems') }}">

        {{-- Keep existing search/filter values --}}
        @foreach(request()->except('sort') as $key => $value)
            @if(is_array($value))
                @foreach($value as $item)
                    <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                @endforeach
            @else
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach

        <div class="flex items-center gap-3">

            <label for="sort" class="font-semibold text-gray-700">
                Sort by:
            </label>

            <select
                name="sort"
                id="sort"
                onchange="this.form.submit()"
                class="border-gray-300 rounded-lg">

                <option value="latest"
                    {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>
                    Newest
                </option>

                <option value="oldest"
                    {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                    Oldest
                </option>

                <option value="reward_high"
                    {{ request('sort') == 'reward_high' ? 'selected' : '' }}>
                    Highest Reward
                </option>

                <option value="reward_low"
                    {{ request('sort') == 'reward_low' ? 'selected' : '' }}>
                    Lowest Reward
                </option>

                <option value="deadline_soon"
                    {{ request('sort') == 'deadline_soon' ? 'selected' : '' }}>
                    Nearest Deadline
                </option>

                <option value="deadline_late"
                    {{ request('sort') == 'deadline_late' ? 'selected' : '' }}>
                    Latest Deadline
                </option>

            </select>

        </div>

    </form>
</div>
<!----------------------------- Results Section  ----------------------------->
        <div class="bg-white shadow rounded-2xl shadow-xl overflow-hidden mb-6">
            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-4 text-left text-sm font-semibold text-gray-700">Title</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-700">Department</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-700">Course</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-700">Difficulty</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-700">Reward</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-700">Deadline</th>
                            <th class="p-4 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="p-4 text-center text-sm font-semibold text-gray-700">Attachment</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($problems as $problem)

                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="p-4">{{ $problem->title }}</td>
                            <td class="p-4">{{ $problem->department }}</td>
                            <td class="p-4">{{ $problem->course }}</td>
                            <td class="p-4">{{ $problem->difficulty }}</td>
                            <td class="p-4">
                                ৳ {{ number_format($problem->reward, 2) }}
                            </td>
                            <td class="p-4">{{ $problem->deadline }}</td>
                            <td class="p-4">
                                @if($problem->status === 'Open')
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                                        🟢Open
                                    </span>
                                @elseif($problem->status === 'In Progress')
                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                                        🟡In Progress
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                @if($problem->attachment)
                                    <a href="{{ asset('storage/' . $problem->attachment) }}" target="_blank" class="inline-block bg-blue-600 text-white px-3 py-1.5 rounded-lg hover:bg-blue-700 text-sm font-medium transition">
                                        View
                                    </a>
                                @else
                                    <span class="text-gray-400">No Attachment</span>
                                @endif
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center p-8">
                                No academic problems available.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>
            </div>

        </div>

    </div>

<script>
    const coursesByDepartment = {
        CSE: [
            'CSE220',
            'CSE321',
            'CSE420'
        ],

        BBA: [
            'BUS101',
            'BUS201',
            'MKT102'
        ],

        EEE: [
            'EEE201',
            'EEE310',
            'EEE420'
        ]
    };

    const departmentSelect = document.getElementById('department');
    const courseSelect = document.getElementById('course');

    const selectedCourse = @json(request('course'));

    function updateCourses() {

        const department = departmentSelect.value;

        courseSelect.innerHTML = '';

        if (!department) {
            courseSelect.innerHTML =
                '<option value="">All Courses</option>';
            return;
        }

        courseSelect.innerHTML =
            '<option value="">All Courses</option>';

        coursesByDepartment[department].forEach(function(course) {

            const option = document.createElement('option');

            option.value = course;
            option.textContent = course;

            if (course === selectedCourse) {
                option.selected = true;
            }

            courseSelect.appendChild(option);
        });
    }

    departmentSelect.addEventListener('change', function () {
        updateCourses();
    });

    updateCourses();
</script>

</x-app-layout>