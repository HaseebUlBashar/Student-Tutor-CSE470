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

                    <div>
                        <label class="block font-semibold mb-2">
                            Department
                        </label>

                        <input
                            type="text"
                            name="department"
                            class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Course
                        </label>

                        <input
                            type="text"
                            name="course"
                            class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Chapter
                        </label>

                        <input
                            type="text"
                            name="chapter"
                            class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Difficulty
                        </label>

                        <select
                            name="difficulty"
                            class="w-full rounded-lg border-gray-300 focus:ring-blue-500">

                            <option>Easy</option>
                            <option>Medium</option>
                            <option>Hard</option>

                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Reward (BDT)
                        </label>

                        <input
                            type="number"
                            name="reward"
                            class="w-full rounded-lg border-gray-300">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">
                            Deadline
                        </label>

                        <input
                            type="date"
                            name="deadline"
                            class="w-full rounded-lg border-gray-300">
                    </div>

                </div>

                <div>
                    <label class="block font-semibold mb-2">
                        Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="w-full rounded-lg border-gray-300">
                </div>

                <div>
                    <label class="block font-semibold mb-2">
                        Description
                    </label>

                    <textarea
                        rows="6"
                        name="description"
                        class="w-full rounded-lg border-gray-300"></textarea>
                </div>

                <div>
                    <label class="block font-semibold mb-2">
                        Upload Image / PDF
                    </label>

                    <input
                        type="file"
                        name="attachment"
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

</x-app-layout>
